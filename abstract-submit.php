<?php
	require 'lib.php';
	
	$form_location = 'abstract';
	$success_location = 'abstract-success';
	
	$required = explode(' ', 'firstname lastname degree institution street_address city state_province zip_postal_code country phone email author_status affiliation_1 author_1_firstname author_1_lastname author_1_affiliation abstract_category presentation_type abstract_title abstract_body');
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
