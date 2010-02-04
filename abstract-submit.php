<?php
	require 'lib.php';
	
	$form_location = 'abstract';
	$success_location = 'abstract-success';
	
	if (!isset($_POST['submitted'])) {
		header("Location:$form_location");
		exit;
	}
	
	$required = array('firstname', 'lastname', 'degree');
	foreach ($required as $field) {
		if (empty($_POST[$field])) {
			header("Location: $form_location?error_$field");
			exit;
		}
	}
	
//	$success = addAbstract($name, $email, $phone);	
//	if ($success) {
		//header("Location:$success_location");
		print_r($_POST);
//	} else {
//		header('Location:register?error_general');
//		exit;
//	}
?>
