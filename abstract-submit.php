<?php
	require 'includes/lib.php';
	
	$form_location = 'abstract';
	$show_location = 'abstract-show';
	$thankyou_location = 'abstract-success';
	
	// Check the desired action -- preview or submit
	$submit = ($_POST['action'] == 'Submit');
	
	// Process the uploaded picture
	// If it's not a valid file, the $_POST variables won't be set, and an error will occur in the validation stage below
	if (is_uploaded_file($_FILES['picture']['tmp_name']) && $_FILES['picture']['size'] <= 1000000) {
		$_POST['picture_tmpname'] = $_FILES['picture']['tmp_name'];
		$_POST['picture_mimetype'] = $_FILES['picture']['type'];
		$_POST['picture'] = $_FILES['picture']['name'];
	}
	
	// Check if we're updating or adding a new record
	if (isset($_GET['id']) && isset($_GET['auth_key'])) {
		$data_auth['id'] = $_GET['id'];
		$data_auth['auth_key'] = $_GET['auth_key'];
		$update = true;
	} else if (isset($_COOKIE['id']) && isset($_COOKIE['auth_key'])) {
		$data_auth['id'] = $_COOKIE['id'];
		$data_auth['auth_key'] = $_COOKIE['auth_key'];
		$update = true;
	} else {
		$update = false;
	}

	// Add the data to the DB
	// This is before validation so that if there's an error, the user won't lose the data
	// TODO: get the return value of addAbstract and redirect with error if it's false
	if ($update) {
		addAbstract($_POST, $data_auth['id'], $data_auth['auth_key']);
	} else {
		$data_auth = addAbstract($_POST);
		
		// Set cookies with id and auth_key so that if the user clicks the back button, he won't lose his data
		setcookie('id', $data_auth['id']);
		setcookie('auth_key', $data_auth['auth_key']);
	}
	$data_auth_query_string = "id=" . $data_auth['id'] . "&auth_key=" . $data_auth['auth_key'];
	
	// Validate the data and redirect to the form if it's wrong
	// First check if the required fields are there
	$required = explode(' ', 'firstname lastname degree institution street_address city state_province zip_postal_code country phone email author_status picture affiliation_1 author_1_firstname author_1_lastname author_1_affiliation abstract_category presentation_type abstract_title abstract_body');
	foreach ($required as $field) {
		if (empty($_POST[$field])) {
			header("Location: $form_location?$data_auth_query_string&error_$field");
			exit;
		}
	}
	// TODO: do conditional validation
	
	if ($submit) {
		// Clear the id and auth_key cookies, because now the user has submitted his abstract already. However, note that the user can still edit the abstract by going to the appropriate URL. This may not be the desired behavior... but it's the easiest thing, and it's probably not a big deal -- the auth_key would still be required to edit.
		setcookie('id', '', time() - 3600);
		setcookie('auth_key', '', time() - 3600);
		
		// Show a thank-you page
		header("Location: $thankyou_location?$data_auth_query_string");
	} else {
		// Show the abstract
		header("Location:$show_location?$data_auth_query_string");
	}
?>
