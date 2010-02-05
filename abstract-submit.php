<?php
	require 'lib.php';
	
	$form_location = 'abstract';
	$show_location = 'abstract-show';
	
	// TODO: if the user uploaded a picture, pass that to {add,update}Abstract
	
	// Add the data to the DB
	if (isset($_GET['id']) && isset($_GET['auth_key'])) {
		updateAbstract($_POST, $_GET['id'], $_GET['auth_key']);
	} else {
		$data_auth = addAbstract($_POST);
	}
	$data_auth_query_string = "id=" . $data_auth['id'] . ";auth_key=" . $data_auth['auth_key'];
	
	// Validate the data and redirect to the form if it's wrong
	// First check if the required fields are there
	$required = explode(' ', 'firstname lastname degree institution street_address city state_province zip_postal_code country phone email author_status affiliation_1 author_1_firstname author_1_lastname author_1_affiliation abstract_category presentation_type abstract_title abstract_body');
	foreach ($required as $field) {
		if (empty($_POST[$field])) {
			header("Location: $form_location?$data_auth_query_string;error_$field");
			exit;
		}
	}
	// TODO: do conditional validation
	
	// Show the abstract
	header("Location:$show_location?$data_auth_query_string");
?>
