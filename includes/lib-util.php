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

/**
 * Inserts one or more key/value pairs $pairs after the given key $key in an associative array $array, returning the new array.
*/
function array_insert_after($array, $key, $pairs) {
	$array_new = array();
	foreach ($array as $k => $v) {
		$array_new[$k] = $v;
		if ($k === $key) {
			foreach ($pairs as $k2 => $v2) {
				$array_new[$k2] = $v2;
			}
		}
	}
	return $array_new;
}

/**
 * Returns an array of references to the original array.
 * Useful for mysqli bind_param -- see http://stackoverflow.com/questions/2045875/pass-by-reference-problem-with-php-5-3-1
 */
function makeRefs($array) {
	$refs = array();
	foreach ($array as $key => $val) {
		$refs[$key] = &$array[$key];
	}
	return $refs;
}

?>
