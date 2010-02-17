<?php
	require 'includes/lib.php';
	
	$form_location = 'register.php';
	$thankyou_location = 'register-success.php';
	
	// Check if there's a pre-existing id and auth_key -- if so, we're updating
	if (isset($_GET['id']) && isset($_GET['auth_key'])) {
		$data_auth['id'] = $_GET['id'];
		$data_auth['auth_key'] = $_GET['auth_key'];
		$update = true;
	} else if (isset($_COOKIE['register_id']) && isset($_COOKIE['register_auth_key'])) {
		$data_auth['id'] = $_COOKIE['register_id'];
		$data_auth['auth_key'] = $_COOKIE['register_auth_key'];
		$update = true;
	} else {
		$update = false;
	}

	// Add the data to the DB
	// This is before validation so that if there's an error, the user won't lose the data
	// TODO: get the return value of addAbstract and redirect with error if it's false
	if ($update) {
		addRegistrant($_POST, $data_auth['id'], $data_auth['auth_key']);
	} else {
		$data_auth = addRegistrant($_POST);
		
		// Set cookies with id and auth_key so that if the user clicks the back button, he won't lose his data
		setcookie('register_id', $data_auth['id']);
		setcookie('register_auth_key', $data_auth['auth_key']);
	}
	$data_auth_query_string = "id=" . urlencode($data_auth['id']) . "&auth_key=" . urlencode($data_auth['auth_key']);
	
	// Validate the data and redirect to the form if it's wrong
	// First check if the required fields are there
	$required = explode(' ', 'firstname lastname degree institution institution_profile street_address email phone submitting_abstract');
	foreach ($required as $field) {
		if (empty($_POST[$field])) {
			header("Location: $form_location?$data_auth_query_string&error_$field#$field"); # no need to escape $field, because it is completely specified in $required above
			exit;
		}
	}
	// TODO: do conditional validation
	
	// Clear the id and auth_key cookies, because now the user has submitted his registration already. However, note that the user can still edit the registration by going to the appropriate URL. This may not be the desired behavior... but it's the easiest thing, and it's probably not a big deal -- the auth_key would still be required to edit.
	setcookie('register_id', '', time() - 3600);
	setcookie('register_auth_key', '', time() - 3600);
	
	// Show a thank-you page
	header("Location: $thankyou_location?$data_auth_query_string");
?>
