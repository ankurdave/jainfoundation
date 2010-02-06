<?php
	require 'lib.php';
	
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=abstracts.doc");
	
	include 'abstract-show-template-head.inc.php';
	
	$db = connectToDB();
	$result = $db->query("SELECT * FROM abstract");
	while ($data = $result->fetch_assoc()) {
		// Escape all data fields before printing
		$data_raw = $data;
		$data = array_map('htmlentities', $data);
	
		include 'abstract-show-template-body.inc.php';
	}
	$result->free();
	
	include 'abstract-show-template-foot.inc.php';
?>
