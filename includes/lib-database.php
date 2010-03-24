<?php

function connectToDB() {
	global $Config;
	
	$db = new mysqli($Config['DB']['Host'], $Config['DB']['User'], $Config['DB']['Password'], $Config['DB']['Database']);
	
	// Make sure Unicode works
	$db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	
	return $db;
}

// Converts a column name into the piece of SQL that should go in the ON DUPLICATE KEY UPDATE clause
function make_column_update_sql($col) {
	return "$col=VALUES($col)";
};

?>
