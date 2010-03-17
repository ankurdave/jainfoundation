<?php

include('config.php');

include 'header-footer.inc.php';

function connectToDB() {
	global $Config;
	$db = new mysqli($Config['DB']['Host'], $Config['DB']['User'], $Config['DB']['Password'], $Config['DB']['Database']);
	
	// Make sure Unicode works
	$db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	
	return $db;
}

/*
 * Adds/updates a registrant in the DB.
 * @param array $data an assoc array with ('column' => 'value')
 * @param string $id the ID of an already-existing column. Will insert a new column if null
 * @param string $auth_key the auth key of an already-existing column. Will insert a new column if null
 */
function addRegistrant($data, $id = null, $auth_key = null) {
	$db = connectToDB();
	
	$data['final'] = $final;
	
	$update = !is_null($id) && !is_null($auth_key);
	if ($update) {
		// Use the given id and auth key
		$data['id'] = $id;
		$data['auth_key'] = $auth_key;
		
		// Check if the id and auth key are actually valid
		$query = $db->prepare("SELECT id FROM registrant WHERE id=? AND auth_key=?");
		$query->bind_param('is', $id, $auth_key);
		$query->execute();
		$query->store_result();
		if ($query->num_rows() < 1) {
			return false;
		}
	} else {
		// Create a new id and auth key
		$result = $db->query("SELECT MAX(id) FROM registrant");
		list($prevId) = $result->fetch_array();
		$data['id'] = $prevId + 1;
		$result->free();
		
		$data['auth_key'] = uniqid('', true); // TODO: use a real uuid for more security
	}

	// Calculate the total price
	if ($now < strtotime('June 16, 2010')) {
	  $other_fee = 200;
	  $postdoc_fee = 150;
	} else {
	  $other_fee = 250;
	  $postdoc_fee = 200;
	}
	$base_fee = 0;
	switch ($data['position']) {
		case "postdoc":
		case "grad_student":
		case "undergrad_student":
			$base_fee = $postdoc_fee;
			break;
		default:
			$base_fee = $other_fee;
	}

	$gala_dinner_guest_fee = 0;
	if (!empty($data['meals_gala_dinner_numguests'])) {
		$gala_dinner_guest_fee = 50 * intval($data['meals_gala_dinner_numguests']);
	}

	$data['total_fee'] = $base_fee + $gala_dinner_guest_fee;

	
	// Build the list of columns
	$columns = explode(' ', 'id auth_key firstname lastname degree degree_other position position_other institution institution_profile institution_profile_other department street_address city state_province zip_postal_code country email phone fax submitting_abstract abstract_title local_attendee hotel_parking attendance_day1 attendance_day2 attendance_day3 attendance_day4 meals_day2_breakfast meals_day2_lunch meals_day3_breakfast meals_day3_lunch meals_day4_breakfast meals_day4_lunch meals_gala_dinner meals_gala_dinner_guests meals_gala_dinner_numguests share_room gender arrival_date departure_date payment_type total_fee');
	$columns_string = join(', ', $columns);
	
	$columns_update = array_map('make_column_update_sql', $columns); // for the ON DUPLICATE KEY UPDATE clause
	$columns_update_string = join(', ', $columns_update);
	
	// Generate the "?, ?, ..." for the VALUES clause
	$column_placeholders = join(', ', array_fill(0, count($columns), '?'));
	
	// Generate the bind_param type argument
	$param_types = '';
	foreach ($columns as $col) {
		if ($col == 'id' || $col == 'total_fee') {
			$type = 'i';
		} else {
			$type = 's';
		}
		$param_types .= $type;
	}
	
	// Store the data in the DB
	$query = $db->prepare("INSERT INTO registrant ($columns_string) VALUES ($column_placeholders) ON DUPLICATE KEY UPDATE $columns_update_string");
	call_user_func_array(array(&$query, 'bind_param'), array_merge(array($param_types), assoc_array_slice($columns, $data)));
	
	$success = $query->execute();
	
	// Return the auth data
	if ($success) {
		return assoc_array_filter(array('id', 'auth_key'), $data);
	} else {
		return $success;
	}
}

/*
 * Adds/updates an abstract in the DB.
 * @param array $data an assoc array with ('column' => 'value')
 * @param boolean $final whether or not to mark the row as final and submitted in the DB
 * @param string $id the ID of an already-existing column. Will insert a new column if null
 * @param string $auth_key the auth key of an already-existing column. Will insert a new column if null
 */
function addAbstract($data, $final = false, $id = null, $auth_key = null) {
	$db = connectToDB();
	
	$data['final'] = $final;
	
	$update = !is_null($id) && !is_null($auth_key);
	if ($update) {
		// Use the given id and auth key
		$data['id'] = $id;
		$data['auth_key'] = $auth_key;
		
		// Check if the id and auth key are actually valid
		$query = $db->prepare("SELECT id FROM abstract WHERE id=? AND auth_key=?");
		$query->bind_param('is', $id, $auth_key);
		$query->execute();
		$query->store_result();
		if ($query->num_rows() < 1) {
			return false;
		}
	} else {
		// Create a new id and auth key
		$result = $db->query("SELECT MAX(id) FROM abstract");
		list($prevId) = $result->fetch_array();
		$data['id'] = $prevId + 1;
		$result->free();
		
		$data['auth_key'] = uniqid('', true); // TODO: use a real uuid for more security
	}
	
	// Set up the picture data for uploading
	$data['picture_data'] = null;
	
	// Build the list of columns
	$column_names = explode(', ', 'id, auth_key, picture_mimetype, picture_data, firstname, middlename, lastname, degree, department, institution, street_address, city, state_province, zip_postal_code, country, phone, fax, email, author_status, author_status_other, degree_year, abstract_category, abstract_category_other, presentation_type, abstract_title, abstract_body, final');
	
	$affiliations = array();
	for ($i = 1; $i <= 8; $i++) {
		$affiliations[] = "affiliation_$i";
	}
	
	$authors = array();
	for ($i = 1; $i <= 8; $i++) {
		$authors[] = "author_{$i}_firstname";
		$authors[] = "author_{$i}_middlename";
		$authors[] = "author_{$i}_lastname";
		$authors[] = "author_{$i}_affiliation";
	}
	
	$columns = array_merge($column_names, $affiliations, $authors);
	$columns_string = join(', ', $columns);
	
	$columns_update = array_map('make_column_update_sql', $columns); // for the ON DUPLICATE KEY UPDATE clause
	$columns_update_string = join(', ', $columns_update);
	
	// Generate the "?, ?, ..." for the VALUES clause
	$column_placeholders = join(', ', array_fill(0, count($columns), '?'));
	
	// Generate the bind_param type argument
	$param_types = '';
	foreach ($columns as $col) {
		if ($col == 'id' || $col == 'final') {
			$type = 'i';
		} else if ($col == 'picture_data') {
			$type = 'b';
		} else {
			$type = 's';
		}
		$param_types .= $type;
	}
	
	// Store the data in the DB
	$query = $db->prepare("INSERT INTO abstract ($columns_string) VALUES ($column_placeholders) ON DUPLICATE KEY UPDATE $columns_update_string");
	call_user_func_array(array(&$query, 'bind_param'), array_merge(array($param_types), assoc_array_slice($columns, $data)));
	
	// Store the picture to the DB
	$filehandle = @fopen($data['picture_tmpname'], 'r');
	if ($filehandle) {
		$picture_data_col_number = array_search('picture_data', $columns);
		while (!feof($filehandle)) {
			$query->send_long_data($picture_data_col_number, fread($filehandle, 8192));
		}
		fclose($filehandle);
	}
	
	$success = $query->execute();
	
	// Return the row data
	if ($success) {
		return assoc_array_filter(array('id', 'auth_key'), $data);
	} else {
		return $success;
	}
}

// Converts a column name into the piece of SQL that should go in the ON DUPLICATE KEY UPDATE clause
function make_column_update_sql($col) {
	return "$col=VALUES($col)";
};

// Returns an assoc array with the abstract data from the DB, or null if it doesn't exist.
function getAbstract($id) {
	$db = connectToDB();
	
	$id_escaped = $db->real_escape_string($id);
	
	$result = $db->query("SELECT * FROM abstract WHERE id='$id_escaped'");
	return $result->fetch_assoc();
}

/**
 * Returns an assoc array with the registrant data from the DB, or null if it doesn't exist.
 */
function getRegistrant($id, $auth_key) {
	$db = connectToDB();
	
	$id_escaped = $db->real_escape_string($id);
	$auth_key_escaped = $db->real_escape_string($auth_key);
	
	$result = $db->query("SELECT * FROM abstract WHERE id='$id_escaped' AND auth_key='$auth_key_escaped'");
	return $result->fetch_assoc();
}

// Looks up each key in $keys in the assoc array $array, then returns an array of the corresponding values in the same order as $keys.
function assoc_array_slice($keys, $array) {
	$values = array();
	foreach ($keys as $key) {
		$values[] = $array[$key];
	}
	return $values;
}

// Looks up each key in $keys in the assoc array $array, then returns an assoc array with only the desired key => value pairs.
function assoc_array_filter($keys, $array) {
	$values = array();
	foreach ($keys as $key) {
		$values[$key] = $array[$key];
	}
	return $values;
}

// Does the job of htmlentities(), except with UTF-8 support
function print_html($string) {
	if (!is_array($string)) {
		return htmlentities($string, ENT_COMPAT, 'UTF-8');
	} else {
		return array_map('print_html', $string); // recurse for arrays
	}
}

// Encodes a CSV field by adding surrounding quotes, and escaping the quote marks within it
function csv_encode($string) {
	return '"' . str_replace('"', '""', $string) . '"';
}

// Checks for an error associated with the given field, and sets the appropriate variables
// TODO: make print_*_field() actually use these functions
function get_error_style($field) {
	if (isset($_GET["error_$field"])) {
		return ' class="error" ';
	} else {
		return '';
	}
}
function get_error_text($field, $text = "(required)") {
	if (isset($_GET["error_$field"])) {
		return $text;
	} else {
		return '';
	}
}

/**
 * Prints a generic form field in an HTML table row.
 * 
 * @param string $id the field id
 * @param array $options an assoc array with the following optional fields:
 * instructions -- string (may contain HTML)
 * required -- boolean
 * label -- string (may contain HTML)
 * value -- assoc array containing ($id => 'field value')
 * class -- array containing other classes to apply to the element
 */
function print_field($id, $element_html, $options = array()) {
?>
	<?php if (isset($_GET["error_$id"])) { ?>
		<tr id="<?php echo htmlentities($id) ?>_container" class="error">
	<?php } else { ?>
		<tr id="<?php echo htmlentities($id) ?>_container">
	<?php } ?>
	
	<?php if ($options['required']) { ?>
		<td class="required_indicator">*</td>
	<?php } else { ?>
		<td></td>
	<?php } ?>

	<td><label for="<?php echo htmlentities($id) ?>"><?php echo $options['label'] ?></label></td>
	
	<td class="input">
		<?php echo $element_html ?>
	</td>
	<td>
		<label for="<?php echo htmlentities($id) ?>">
			<?php echo $options['instructions'] ?>
		</label>
	</td>
	
	</tr>
<?php
}

/**
 * Prints a file form field.
 * 
 * @param string $id the field id
 * @param array $options an assoc array with the field options in print_field()
 */
function print_upload_field($id, $options = array()) {
	$id_esc = htmlentities($id);
	$classes_html = build_class_attribute($options['required'], $options['class']);
	
	$element_html = <<<EOD
<input type="file" name="$id_esc" id="$id_esc" $classes_html />
EOD;

	print_field($id, $element_html, $options);
}

/**
 * Creates the class attribute for a form field.
 * Internal function intended for use by print_*_field()
 * 
 * @param boolean $required whether or not the 'required' class should be included
 * @param array $extra_classes an array of extra classes to apply
 */
function build_class_attribute($required, $extra_classes) {
	// Prepare the options
	// This allows people to pass in undefined for $classes (instead of an empty array) if they want it to be empty
	if (!is_array($extra_classes)) {
		$extra_classes = array();
	}
	
	// Build the class string
	$classes = array();
	if ($required) {
		$classes[] = 'required';
	}
	$classes = array_merge($classes, array_map('htmlentities', $extra_classes));
	$classes_html = 'class="' . join(' ', $classes) . '"';
	return $classes_html;
}

/**
 * Prints a text form field.
 * 
 * @param string $id the field id
 * @param array $options an assoc array with the field options in print_field()
 */
function print_text_field($id, $options = array()) {
	$id_esc = htmlentities($id);
	$value_esc = print_html($options['value'][$id]);
	$classes_html = build_class_attribute($options['required'], $options['class']);
	
	$element_html = <<<EOD
<input type="text" name="$id_esc" id="$id_esc" value="$value_esc" $classes_html />
EOD;

	print_field($id, $element_html, $options);
}

/**
 * Prints a select form field (a dropdown).
 * 
 * @param string $id the field id
 * @param array $options an assoc array with the field options in print_field(), plus:
 * 'options' => array('option_value' => 'option_label')
 */
function print_select_field($id, $options = array()) {
	$id_esc = htmlentities($id);
	$classes_html = build_class_attribute($options['required'], $options['class']);
	
	$options_array = array();
	foreach ($options['options'] as $option_value => $option_label) {
		$options_array[] = convertOptiontoHTML($option_value, $option_label, $options['value'][$id] == $option_value);
	}
	$options_html = join("\n", $options_array);
	
	$element_html = <<<EOD
<select name="$id_esc" id="$id_esc" $classes_html>
	$options_html
</select>
EOD;

	print_field($id, $element_html, $options);
}

/**
 * Creates an HTML option in a select form field.
 * Internal function intended for use by print_select_field()
 * 
 * @param string $option_value the value, or id, of the option
 * @param string $option_label the user-visible label for the option
 * @param boolean $selected whether or not this is the default option
 */
function convertOptionToHTML($option_value, $option_label, $selected = false) {
	if ($selected) {
		$selected_html = 'selected="selected"';
	} else {
		$selected_html = '';
	}
	return <<<EOD
<option value="$option_value" $selected_html>$option_label</option>
EOD;
}

/**
 * Prints a set of radio buttons.
 * 
 * @param string $id the field id
 * @param array $options an assoc array with the field options in print_field(), plus:
 * 'options' => array('option_value' => 'option_label')
 */
function print_radio_field($id, $options = array()) {
	$id_esc = htmlentities($id);
	$classes_html = build_class_attribute($options['required'], $options['class']);
	
	$options_array = array();
	foreach ($options['options'] as $option_value => $option_label) {
		$options_array[] = convertOptiontoHTMLRadio($id_esc, $option_value, $option_label, $classes_html, $options['value'][$id] == $option_value);
	}
	$options_html = join("\n", $options_array);
	
	$element_html = <<<EOD
<div id="$id_esc" $classes_html>
	$options_html
</div>
EOD;

	print_field($id, $element_html, $options);
}

/**
 * Creates an HTML option in a select form field.
 * Internal function intended for use by print_select_field()
 * 
 * @param string $id_esc the html-escaped name of the radio button set
 * @param string $option_value the value, or id, of the option
 * @param string $option_label the user-visible label for the option
 * @param string $classes_html the html attribute for the classes to apply to the radio button
 * @param boolean $selected whether or not this is the default option
 */
function convertOptionToHTMLRadio($id_esc, $option_value, $option_label, $classes_html, $selected = false) {
	if ($selected) {
		$selected_html = 'selected="selected"';
	} else {
		$selected_html = '';
	}
	return <<<EOD
<label>
	<input type="radio" name="$id_esc" value="$option_value" $classes_html $selected />
	$option_label
</label>
EOD;
}

/**
 * Prints an HTML textarea form field.
 * 
 * @param string $id the field id
 * @param array $options an assoc array with the following optional fields:
 * instructions -- string
 * required -- boolean
 * label -- string
 * value -- assoc array containing ($id => 'field value')
 * class -- array containing other classes to apply to the element
 */
function print_textarea_field($id, $options = array()) {
	$classes_html = build_class_attribute($options['required'], $options['class']);
?>
	<table>
	<?php if (isset($_GET["error_$id"])) { ?>
		<tr class="error">
	<?php } else { ?>
		<tr>
	<?php } ?>

	<?php if ($options['required']) { ?>
		<td class="required_indicator">*</td>
	<?php } else { ?>
		<td></td>
	<?php } ?>

	<td><label for="<?php echo htmlentities($id) ?>"><?php echo $options['label'] ?></label></td>
	
	</tr>
	</table>

	<p><?php echo htmlentities($options['instructions']) ?></p>

	<p><textarea
		name="<?php echo htmlentities($id) ?>"
		id="<?php echo htmlentities($id) ?>"
		rows="24" cols="80"
		<?php echo $classes_html ?>
	><?php echo print_html($options['value'][$id]) ?></textarea></p>
<?php
}

/**
 * Prints multiple text fields in an HTML table row.
 * 
 * @param array $id_prefix the field id stem that will be concatenated with each of the field ids in $fields
 * @param array $fields an assoc array containing ($id_suffix => $required), where $required is a boolean
 * @param array $options an assoc array with the following optional fields:
 * label -- string
 * value -- assoc array containing ($id => 'field value')
 * class -- assoc array containing ($id_suffix => array('class1', 'class2', ...)
 */
function print_multi_text_field($id_prefix, $fields, $options = array()) {
?>
	<tr>
	<th class="label"><?php echo htmlentities($options['label']) ?></th>

	<?php
		foreach (array_keys($fields) as $id_suffix) {
			$id = $id_prefix . $id_suffix;
			$classes_html = build_class_attribute($fields[$id_suffix], $options['class'][$id_suffix]);
	?>
		<?php if (isset($_GET["error_$id"])) { ?>
			<td class="error">
		<?php } else { ?>
			<td>
		<?php } ?>

		<input type="text"
			name="<?php echo htmlentities($id) ?>"
			id="<?php echo htmlentities($id) ?>"
			value="<?php echo print_html($options['value'][$id]) ?>"
			<?php echo $classes_html ?>
		/>

		</td>
	<?php } ?>
	
	</tr>
<?php
}

/**
 * Returns the beginning (BOM) of a Unicode Excel file.
 */
function xlsBegin() {
    return chr(255) . chr(254);
}

/**
 * Returns an Excel row.
 * @param array $row the cells to print
 */
function xlsWriteRow($row) {
    return mb_convert_encoding(join("\t", array_map('remove_linebreaks', $row)) . "\r\n", 'UTF-16LE', 'UTF-8');
}

function remove_linebreaks($text) {
	$text = str_replace("\n", '', $text);
	$text = str_replace("\r", '', $text);
	return $text;
}
?>
