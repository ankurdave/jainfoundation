<?php

include('config.php');

function connectToDB() {
	global $Config;
	$db = new mysqli($Config['DB']['Host'], $Config['DB']['User'], $Config['DB']['Password'], $Config['DB']['Database']);
	
	// Make sure Unicode works
	$db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	
	return $db;
}

function addAbstract($data) {
	$db = connectToDB();
	
	// Create the auth key
	$data['auth_key'] = uniqid('', true); // TODO: use a real uuid for more security
	
	// Set up the picture data for uploading
	$data['picture_data'] = null;
	
	// Build the list of columns
	$column_names = explode(', ', 'id, auth_key, picture_mimetype, picture_data, firstname, middlename, lastname, degree, department, institution, street_address, city, state_province, zip_postal_code, country, phone, fax, email, author_status, degree_year, abstract_category, abstract_category_other, presentation_type, abstract_title, abstract_body');
	
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
	
	$columns = array_merge($column_names, $affiliations, $authors); // note: make sure $column_names comes first, so that id is the first one and $param_types matches up
	$columns_string = join(', ', $columns);
	
	// Generate the "?, ?, ..." for the VALUES clause
	$column_placeholders = join(', ', array_fill(0, count($columns), '?'));
	
	// Generate the bind_param type argument
	$param_types = '';
	foreach ($columns as $col) {
		if ($col == 'id') {
			$type = 'i';
		} else if ($col == 'picture_data') {
			$type = 'b';
		} else {
			$type = 's';
		}
		$param_types .= $type;
	}
	
	// Get the next row id
	$result = $db->query("SELECT MAX(id) FROM abstract");
	list($prevId) = $result->fetch_array();
	$data['id'] = $prevId + 1;
	$result->free();
	
	// Store the data in the DB
	// TODO: see ibfilestore for how to pass the picture efficiently
	$query = $db->prepare("INSERT INTO abstract ($columns_string) VALUES ($column_placeholders)");
	call_user_func_array(array(&$query, 'bind_param'), array_merge(array($param_types), assoc_array_slice($columns, $data)));
	
	// Store the picture to the DB
	$filehandle = @fopen($data['picture_filename'], 'r');
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

// Returns an assoc array with the abstract data from the DB, or null if it doesn't exist.
function getAbstract($id, $auth_key) {
	$db = connectToDB();
	
	$id_escaped = $db->real_escape_string($id);
	$auth_key_escaped = $db->real_escape_string($auth_key);
	
	$result = $db->query("SELECT * FROM abstract WHERE id='$id_escaped' && auth_key='$auth_key_escaped'");
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
	return htmlentities($string, ENT_COMPAT, 'UTF-8');
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

// Prints a textarea field.
// Note that no HTML escaping is done. Do it yourself.
function print_textarea_field($field, $label, $instructions = '', $required = '(required)') {
	$classError = isset($_GET["error_$field"]) ? ' class="error"' : '';
	?>
	<table>
		<tr<?php echo $classError?>>
			<?php
			if (!is_null($required)) {
			?>
				<td class="required">*</td>
			<?php
			} else {
			?>
				<td></td>
			<?php
			}
			?>
			<td><label for="<?php echo $field ?>"><?php echo $label ?></label></td>
		</tr>
	</table>
	<p><?php echo $instructions ?></p>
	<textarea name="<?php echo $field ?>" id="<?php echo $field ?>" rows="24" cols="80"></textarea><br />
	</p>
	<?php
}

// Prints multiple text fields
function print_multi_text_field($fieldset_basename, $fieldset_label, $fields) {
	?>
	<tr>
		<td class="label"><?php echo $fieldset_label ?></td>
	<?php
	foreach (array_keys($fields) as $field_ext) {
		$field_full = $fieldset_basename . $field_ext;
		$classError = isset($_GET["error_$field_full"]) ? ' class="error"' : '';
	?>
		<td<?php echo $classError ?>>
			<input type="text" name="<?php echo $field_full ?>" id="<?php echo $field_full ?>" />
		</td>
	<?php
	}
	?>
	</tr>
	<?php
}

// Prints a generic form field. If $required is null, it means it's optional; otherwise the value of $required is the error message when the user leaves the field blank.
// Note that no HTML escaping is done. Do it yourself.
function print_field($field, $label, $inputElem, $instructions = '', $required = '(required)') {
	$classError = isset($_GET["error_$field"]) ? ' class="error"' : '';
	?>
	<tr<?php echo $classError?>>
	<?php
	if (!is_null($required)) {
	?>
		<td class="required">*</td>
	<?php
	} else {
	?>
		<td></td>
	<?php
	}
	?>
	<td><label for="<?php echo $field ?>"><?php echo $label ?></label></td>
	<td>
		<?php echo $inputElem ?>
		<?php
		if (isset($_GET["error_$field"]) && !is_null($required)) {
			echo $required;
		}
		?>
		<?php echo $instructions ?>
	</tr>
	<?php
}

// Prints a text form field.
// Note that no HTML escaping is done. Do it yourself.
function print_upload_field($field, $label, $instructions = '', $required = '(required)') {
	$inputElem = <<<EOD
<input type="file" name="$field" id="$field" />
EOD;

	print_field($field, $label, $inputElem, $instructions, $required);
}

// Prints a text form field.
// Note that no HTML escaping is done. Do it yourself.
function print_text_field($field, $label, $instructions = '', $required = '(required)') {
	$inputElem = <<<EOD
<input type="text" name="$field" id="$field" />
EOD;

	print_field($field, $label, $inputElem, $instructions, $required);
}

// Prints a select form field (a dropdown). $options should be an associative array of option_value => option_label.
// Note that no HTML escaping is done. Do it yourself.
function print_select_field($field, $label, $options, $instructions = '', $required = '(required)') {
	$optionsElems = join("\n", array_map('convertOptionToHTML', array_keys($options), array_values($options)));
	$inputElem = <<<EOD
<select name="$field" id="$field">
	$optionsElems
</select>
EOD;

	print_field($field, $label, $inputElem, $instructions, $required);
}

function convertOptionToHTML($option_value, $option_label) {
	return <<<EOD
<option value="$option_value">$option_label</option>
EOD;
}
?>
