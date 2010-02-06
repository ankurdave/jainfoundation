<?php
	require 'lib.php';
	
	$form_location = 'abstract';
	
	$data = getAbstract($_GET['id'], $_GET['auth_key']);
	if (!$data) {
		header("Location: $form_location");
		exit;
	}
	
	// Output the image
	header("Content-Type: " . $data['picture_mimetype']);
	
	echo $data['picture_data'];
?>

