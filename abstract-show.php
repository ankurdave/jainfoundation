<?php
	require 'lib.php';
	
	$form_location = 'abstract';
	
	if (isset($_GET['id'])) {
		$data = getAbstract($_GET['id']);
	} else if (isset($_COOKIE['id'])) {
		$data = getAbstract($_COOKIE['id']);
	}

	if (!$data) {
		header("Location: $form_location");
		exit;
	}
	
	// Escape all data fields before printing
	$data_raw = $data;
	$data = array_map('htmlentities', $data);
	
	// Output a Word document with HTML in it
	// See http://stackoverflow.com/questions/124959/create-word-document-using-php-in-linux#answer-125009
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=abstract-" . $data['id'] . ".doc");
	
	include 'abstract-show-template.inc.php';
?>