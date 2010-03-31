<?php
	require 'includes/lib.php';

	$db = connectToDB();
	
	$form_location = 'register.php';
	$thankyou_location = 'register-success.php';

	// Load or create the DAO with id and auth_key
	if (isset($_GET['id']) && isset($_GET['auth_key'])) {
		$registrant = new RegistrantDAO($db, $_GET['id']);
		$registrant->setField('auth_key', $_GET['auth_key']);
	} else if (isset($_COOKIE['register_id']) && isset($_COOKIE['register_auth_key'])) {
		$registrant = new RegistrantDAO($db, $_COOKIE['register_id']);
		$registrant->setField('auth_key', $_COOKIE['register_auth_key']);
	} else {
		$registrant = new RegistrantDAO($db);
	}

	// Send the rest of the fields to the DAO
	foreach ($_POST as $field => $val) {
		// If any field in $_POST is not a valid abstract field, setField will ignore it
		$registrant->setField($field, $val);
	}

	// Set cookies and GET string with id and auth_key so that if the user clicks the back button, he won't lose his data
	setcookie('register_id', $registrant->getField('id'));
	setcookie('register_auth_key', $registrant->getField('auth_key'));
	$data_auth_query_string = "id=" . urlencode($registrant->getField('id')) . "&auth_key=" . urlencode($registrant->getField('auth_key'));

	// Save the DAO
	// This is before validation so that if there's an error, the user won't lose the data
	try {
		$registrant->save();
	} catch (DAOAuthException $e) {
		header("Location: $form_location?error_auth");
		exit;
	}

	// Validate the data and redirect to the form if it's wrong
	$invalidFields = $registrant->validate();
	if (count($invalidFields) > 0) {
		function makeFieldErrorString($field) {
			return urlencode("error_$field");
		}

		$invalidFieldsQueryString = join('&', array_map('makeFieldErrorString', $invalidFields));

		header("Location: $form_location?$data_auth_query_string&$invalidFieldsQueryString#" . urlencode($invalidFields[0]));
		exit();
	}

	// Clear the id and auth_key cookies, because now the user has submitted his abstract already.
	setcookie('register_id', '', time() - 3600);
	setcookie('register_auth_key', '', time() - 3600);

	// Show a thank-you page
	header("Location: $thankyou_location?$data_auth_query_string");
	
	// Send an email
	include 'Mail.php';
	$registrantID = urlencode($registrant->getField('id'));
	$submitterName = print_html($registrant->getField('firstname')) . ' ' . print_html($registrant->getField('lastname'));
	$mail = Mail::factory('smtp', $Config['ConferenceNotificationEmail']);
	$headers = array(
		'From' => $Config['ConferenceNotificationEmail']['from'],
		'To' => $Config['ConferenceNotificationEmail']['to'],
		'Subject' => "Registration #$registrantID submitted by $submitterName",
	);
	$body = <<<EOT
Registration list: {$Config['FullURL']}/conference2010/register-list.php#registrant$registrantID

Registration export: {$Config['FullURL']}/conference2010/register-export.php
EOT;
	$mail->send($Config['ConferenceNotificationEmail']['to'], $headers, $body);
?>
