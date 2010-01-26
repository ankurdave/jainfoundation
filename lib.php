<?php

include('config.php');

function connectToDB() {
	global $Config;
	return new mysqli($Config['DB']['Host'], $Config['DB']['User'], $Config['DB']['Password'], $Config['DB']['Database']);
}

// Returns the ID3 information of a song, using the database as a cache
function addPerson($name, $email, $phone) {
	static $db = null;
	if ($db == null) $db = connectToDB();
	
	// Store the metadata in the DB
	static $query = null;
	if ($query == null) $query = $db->prepare('INSERT INTO person (name, email, phone) VALUES (?, ?, ?)');
	$query->bind_param('sss', $name, $email, $phone);
	$success = $query->execute();
	return $success;
}
?>
