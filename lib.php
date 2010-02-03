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
?>
