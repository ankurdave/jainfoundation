<?php
	require 'includes/lib.php';
	
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=abstracts.doc");
	
	include 'includes/abstract-show-template-head.inc.php';
	
	$db = connectToDB();
	$result = $db->query("SELECT * FROM abstract WHERE final=TRUE");
	while ($data = $result->fetch_assoc()) {
		// Escape all data fields before printing
		$data_raw = $data;
		$data = array_map('print_html', $data);
	
		include 'includes/abstract-show-template-body.inc.php';
	}
	$result->free();
	
	include 'includes/abstract-show-template-foot.inc.php';
?>
