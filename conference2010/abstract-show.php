<?php
	require 'includes/lib.php';
	
	$form_location = 'abstract.php';
	
	// Load the abstract using the DAO
	$abstract = null;
	if (isset($_GET['id'])) {
		$abstract = new AbstractDAO($_GET['id']);
	} else if (isset($_COOKIE['id'])) {
		$abstract = new AbstractDAO($_COOKIE['id']);
	} else {
		header("Location: $form_location");
		exit;
	}
	
	// Output a Word document with HTML in it
	// See http://stackoverflow.com/questions/124959/create-word-document-using-php-in-linux#answer-125009
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=abstract-" . urlencode($abstract->getField('id')) . ".doc");

	printAbstractHead();
	printAbstractBody($abstract);
	printAbstractFoot();
?>
