<?php
	require 'lib.php';
	
	$form_location = 'abstract';
	
	if (isset($_GET['id']) && isset($_GET['auth_key'])) {
		$data = getAbstract($_GET['id'], $_GET['auth_key']);
	} else if (isset($_COOKIE['id']) && isset($_COOKIE['auth_key'])) {
		$data = getAbstract($_COOKIE['id'], $_COOKIE['auth_key']);
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
