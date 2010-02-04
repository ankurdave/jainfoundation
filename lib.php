<?php

include('config.php');

function connectToDB() {
	global $Config;
	$db = new mysqli($Config['DB']['Host'], $Config['DB']['User'], $Config['DB']['Password'], $Config['DB']['Database']);
	
	// Make sure Unicode works
	$db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	
	return $db;
}

function addPerson($name, $email, $phone) {
	static $db = null;
	if ($db == null) $db = connectToDB();
	
	// Store the data in the DB
	static $query = null;
	if ($query == null) $query = $db->prepare('INSERT INTO person (name, email, phone) VALUES (?, ?, ?)');
	$query->bind_param('sss', $name, $email, $phone);
	$success = $query->execute();
	return $success;
}

function addAbstract($firstname, $middlename, $lastname, $degree) {
	static $db = null;
	if ($db == null) $db = connectToDB();
	
	// Store the data in the DB
	static $query = null;
	if ($query == null) $query = $db->prepare('INSERT INTO abstract (firstname, middlename, lastname, degree) VALUES (?, ?, ?, ?)');
	$query->bind_param('ssss', $firstname, $middlename, $lastname, $degree);
	$success = $query->execute();
	return $success;
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

// Prints a generic form field.
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
