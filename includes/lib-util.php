<?php

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

?>
