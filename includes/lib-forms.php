<?php

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
 * Builds a query string of the form ?key1=val1&key2=val2 from the given assoc array $params. Does not do any escaping of the keys and values. Only includes a key/value pair if the value is not empty, as reported by the standard empty() function (http://php.net/manual/en/function.empty.php).
 * 
 * @param array $params an assoc array of the form array('key1' => 'val1', 'key2' => 'val2')
 * @param boolean $htmlEncode whether or not to HTML-encode the ampersands that separate the key/value pairs. Defaults to false.
 */
function buildQueryString($params, $htmlEncode = false) {
	// Convert the key-value pairs in $params into a flat array of pairs separated by equals signs
	$paramsProcessed = array();
	foreach ($params as $key => $val) {
		if (!empty($val)) {
			$paramsProcessed[] = "$key=$val";
		}
	}

	// Join them up into a query string
	$separator = $htmlEncode ? '&amp;' : '&';
	$queryString = '?' . join($separator, $paramsProcessed);

	return $queryString;
}

/**
 * Prints a generic form field in an HTML table row.
 * 
 * @param string $id the field id
 * @param array $options an assoc array with the following optional fields:
 * instructions -- string (may contain HTML)
 * required -- boolean
 * label -- string (may contain HTML)
 * value -- field value
 * class -- array containing other classes to apply to the element
 */
function print_field($id, $element_html, $options = array()) {
	$classesHtml = build_class_attribute(
		$options['required'],
		isset($_GET["error_$id"])
			? array('error')
			: array()
	);

	$idHtml = htmlentities($id);

	print <<<EOS
<tr id="{$idHtml}_container" $classesHtml>
	<td class="required-indicator">*</td>
	<td><label for="$idHtml">$options[label]</label></td>
	<td class="input">$element_html</td>
	<td><label for="$idHtml">$options[instructions]</label></td>	
</tr>
EOS;
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
	$value_esc = print_html($options['value']);
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
		$options_array[] = convertOptiontoHTML($option_value, $option_label, $options['value'] == $option_value);
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
		$options_array[] = convertOptiontoHTMLRadio($id_esc, $option_value, $option_label, $classes_html, $options['value'] == $option_value);
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
		$selected_html = 'checked="checked"';
	} else {
		$selected_html = '';
	}
	return <<<EOD
<label>
	<input type="radio" name="$id_esc" value="$option_value" $classes_html $selected_html />
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
 * value -- the field value
 * class -- array containing other classes to apply to the element
 */
function print_textarea_field($id, $options = array()) {
	if (isset($_GET["error_$id"])) {
		array_push($options['class'], 'error');
	}
	$classes_html = build_class_attribute($options['required'], $options['class']);
?>
	<table>
	<tr <?php echo $classes_html ?>>

	<td class="required-indicator">*</td>

	<td><label for="<?php echo htmlentities($id) ?>"><?php echo $options['label'] ?></label></td>
	
	</tr>
	</table>

	<p><?php echo htmlentities($options['instructions']) ?></p>

	<p><textarea
		name="<?php echo htmlentities($id) ?>"
		id="<?php echo htmlentities($id) ?>"
		rows="24" cols="80"
		<?php echo $classes_html ?>
	><?php echo print_html($options['value']) ?></textarea></p>
<?php
}

/**
 * Prints a text field that fits in a single HTML table cell. Intended for multiple fields side-by-side.
 * 
 * @param string $id the field id
 * @param array $options an assoc array with the field options in print_field()
 */
function print_multi_text_field($id, $options = array()) {
	if (isset($_GET["error_$id"])) {
		array_push($options['class'], 'error');
	}
	$classes_html = build_class_attribute($options['required'], $options['class']);
?>
	<td <?php echo $classes_html ?>>
	<input type="text"
		name="<?php echo htmlentities($id) ?>"
		id="<?php echo htmlentities($id) ?>"
		value="<?php echo print_html($options['value']) ?>"
		<?php echo $classes_html ?>
	/>
	</td>
<?php
}

?>
