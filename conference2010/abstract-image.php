<?php
	require 'includes/lib.php';
	
	$form_location = 'abstract.php';
	
	// Load the abstract using the DAO
	if (isset($_GET['id'])) {
		$abstract = new AbstractDAO($_GET['id']);
	} else {
		header("Location: $form_location");
		exit;
	}
	
	// Output the image
	header("Content-Type: " . urlencode($abstract->getField('picture_mimetype')));
	
	echo $abstract->getField('picture_data');
?>

