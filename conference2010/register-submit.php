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
if ($_POST['action'] == 'Preview Abstract') {
	$next_location = 'abstract-show.php?id=' . urlencode($registrant->getField('id'));
} else if (isset($_POST['jump1'])) {
	$next_location = $forms[1];
} else if (isset($_POST['jump2'])) {
	$next_location = $forms[2];
} else if (isset($_POST['jump3'])) {
	$next_location = $forms[3];
} else {
	$next_location = $forms[$formNumber + 1];
}

if (!isset($form_location) || !isset($next_location)) {
	header("Location: register.php");
	exit();
}

// Clear the lists if necessary
if ($formNumber == 2) {
	if (!is_null($registrant->getAbstract())) {
		$registrant->getAbstract()->clearAuthors();
		$registrant->getAbstract()->clearAffiliations();
	}
}
if ($formNumber == 3) {
	$registrant->clearGalaGuests();
}
// Send the relevant fields to the DAOs
foreach ($_POST as $field => $val) {
	if (is_null($val) || $val === "") {
		continue;
	}

	// RegistrantDAO
	if (isset(RegistrantDAO::$columnTypes[$field])) {
		$registrant->setField($field, $val);
	}

	// AbstractDAO
	if (isset(AbstractDAO::$columnTypes[$field])) {
		$registrant->getAbstractInit()->setField($field, $val);
	}

	// RegistrantGalaGuestDAO
	if (preg_match('/^meals_gala_dinner_guest_(\d+)_(.*)$/i', $field, $matches)) {
		$registrant->getGalaGuest($matches[1])->setField($matches[2], $val);
	}

	// AbstractAffiliationDAO
	if (preg_match('/^affiliation_(\d+)$/i', $field, $matches)) {
		$registrant->getAbstractInit()->getAffiliation($matches[1])->setField('affiliation', $val);
	}

	// AbstractAuthorDAO
	if (preg_match('/^author_(\d+)_(.*)$/i', $field, $matches)) {
		$registrant->getAbstractInit()->getAuthor($matches[1])->setField($matches[2], $val);
	}
}

// Send the uploaded picture to the DAO
// Important: This MUST come after the general $_POST import, otherwise it would be possible to set a POST field called 'picture_data' to an arbitrary file system path
if (is_uploaded_file($_FILES['picture']['tmp_name']) && $_FILES['picture']['size'] <= 1000000) {
	$registrant->getAbstractInit()->setField('picture_data', $_FILES['picture']['tmp_name']);
	$registrant->getAbstractInit()->setField('picture_mimetype', $_FILES['picture']['type']);
}

// Save the DAO
// This is before validation so that if there's an error, the user won't lose the data
try {
	$registrant->save($next_location == $forms[4]); // Mark the submission as final if the next page is the thank-you page
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

// If submitting, clear the cookies
setcookie('register_id', '', time() - 3600);
setcookie('register_auth_key', '', time() - 3600);

// Go to the next page
header("Location: $next_location?$data_auth_query_string");

// If submitting, send an email
if ($next_location == $forms[4]) {
	// Check whether or not a abstract email should be sent
	$sendAbstractEmail = !is_null($registrant->getAbstract());
	
	// Send the registrant+abstract email
	include 'Mail.php';
	$registrantID = urlencode($registrant->getField('id'));
	if ($sendAbstractEmail) {
		$abstractID = urlencode($registrant->getAbstract()->getField('id'));
	}
	$submitterName = print_html($registrant->getField('firstname')) . ' ' . print_html($registrant->getField('lastname'));

	$mail = Mail::factory('smtp', $Config['ConferenceNotificationEmail']);
	$headers = array(
		'From' => $Config['ConferenceNotificationEmail']['from'],
		'To' => $Config['ConferenceNotificationEmail']['to'],
		'Subject' => ($sendAbstractEmail
		              ? "Registration #$registrantID and Abstract #$abstractID submitted by $submitterName"
		              : "Registration #$registrantID submitted by $submitterName"),
	);
	$body = <<<EOT
Registration list: {$Config['FullURL']}/conference2010/register-list.php#registrant$registrantID
Registration export: {$Config['FullURL']}/conference2010/register-export.php
EOT;
	if ($sendAbstractEmail) {
		$body .= <<<EOT


Abstract: {$Config['FullURL']}/conference2010/abstract-show.php?id=$abstractID
Abstract submission info list: {$Config['FullURL']}/conference2010/abstract-list.php#abstract$abstractID
Abstract submission info export: {$Config['FullURL']}/conference2010/abstract-export.php
EOT;
	}

	$mail->send($Config['ConferenceNotificationEmail']['to'], $headers, $body);
}

?>
