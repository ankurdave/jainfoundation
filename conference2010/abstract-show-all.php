<?php
	require 'includes/lib.php';
	
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=abstracts.doc");
	
	include 'includes/abstract-show-template-head.inc.php';
	
	$db = connectToDB();
	$result = $db->query("SELECT id FROM abstract WHERE final=TRUE");
	while ($row = $result->fetch_row()) {
		global $abstract;
		$abstract = new AbstractDAO($row[0]);

		include 'includes/abstract-show-template-body.inc.php';
	}
	$result->free();
	
	include 'includes/abstract-show-template-foot.inc.php';
?>
