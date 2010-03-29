<?php
	require 'includes/lib.php';
	
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=abstracts.doc");
	
	printAbstractHead();
	
	$db = connectToDB();
	$result = $db->query("SELECT id FROM abstract WHERE final=TRUE");
	while ($row = $result->fetch_row()) {
		$abstract = new AbstractDAO($row[0]);
		printAbstractBody($abstract);
	}
	$result->free();
	
	printAbstractFoot();
?>
