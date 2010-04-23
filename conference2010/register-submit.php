<?php

require 'includes/lib.php';

$db = connectToDB();

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

// Figure out what form we came from and what form we're going to
// Also handle abstract previewing
$forms = array(
	1 => 'register.php',
	2 => 'register-2.php',
	3 => 'register-3.php',
	4 => 'register-success.php',
);

$formNumber = $_POST['form_number'];
$form_location = $forms[$formNumber];
$next_location = ($_POST['action'] == 'Preview Abstract')
	? 'abstract-show.php?id=' . urlencode($registrant->getField('id'))
	: $forms[$formNumber + 1];

if (!defined($form_location) || !defined($next_location)) {
	header("Location: register.php");
	exit();
}

// Clear the lists if necessary
if ($formNumber == 3) {
	$registrant->clearGalaGuests();
}
// Send the relevant fields to the DAOs
// If any field in $_POST is not a valid field for a DAO, setField will ignore it
foreach ($_POST as $field => $val) {
	// RegistrantDAO
	$registrant->setField($field, $val);

	// AbstractDAO
	$registrant->getAbstract()->setField($field, $val);

	// RegistrantGalaGuestDAO
	if (preg_match('/^meals_gala_dinner_guest_(\d+)_(.*)$/i', $field, $matches)) {
		$registrant->getGalaGuest($matches[1])->setField($matches[2], $val);
	}
}

// Send the uploaded picture to the DAO
// Important: This MUST come after the general $_POST import, otherwise it would be possible to set a POST field called 'picture_data' to an arbitrary file system path
if (is_uploaded_file($_FILES['picture']['tmp_name']) && $_FILES['picture']['size'] <= 1000000) {
	$registrant->getAbstract()->setField('picture_data', $_FILES['picture']['tmp_name']);
	$registrant->getAbstract()->setField('picture_mimetype', $_FILES['picture']['type']);
}

// Save the DAO
// This is before validation so that if there's an error, the user won't lose the data
try {
	$registrant->save();
} catch (DAOAuthException $e) {
	header("Location: $form_location?error_auth");
	exit;
}

// Set cookies and GET string with id and auth_key so that if the user clicks the back button, he won't lose his data
setcookie('register_id', $registrant->getField('id'));
setcookie('register_auth_key', $registrant->getField('auth_key'));
$data_auth_query_string = "id=" . urlencode($registrant->getField('id')) . "&auth_key=" . urlencode($registrant->getField('auth_key'));

// Validate the data and redirect to the form if it's wrong
$invalidFields = $registrant->validate($_POST['form_number']);
if (count($invalidFields) > 0) {
	function makeFieldErrorString($field) {
		return urlencode("error_$field");
	}

	$invalidFieldsQueryString = join('&', array_map('makeFieldErrorString', $invalidFields));

	header("Location: $form_location?$data_auth_query_string&$invalidFieldsQueryString#" . urlencode($invalidFields[0]));
	exit();
}

// Go to the next page
header("Location: $next_location?$data_auth_query_string");

// Send an email
if ($formNumber == 3) {
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
}

?>
