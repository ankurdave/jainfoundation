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

// List of forms
$forms = array(
	1 => 'register.php',
	2 => 'register-2.php',
	3 => 'register-3.php',
	4 => 'register-success.php',
	'thankyou_abstract' => 'register-abstract-success.php',
	'preview_abstract' => 'abstract-show.php',
);

// Figure out the indices (into $forms) for the form we came from and the form we're going to.
$formIndex = $_POST['form_number'];
if (isset($_POST['preview_abstract'])) {
	$nextIndex = 'preview_abstract';
} else if (isset($_POST['jump_prev'])) {
	$nextIndex = $formIndex - 1;
} else {
	$nextIndex = $formIndex + 1;
}

$submitting = ($nextIndex == 4); // Must come before the checking which thank-you page step, because that modifies $nextIndex if submitting an abstract

// Check which thank you page we're going to
if ($nextIndex == 4 && !is_null($registrant->getAbstract())) {
	$nextIndex = 'thankyou_abstract';
}

// Make sure the calculated form and next locations are valid (defined in the $forms table)
if (!isset($forms[$formIndex]) || !isset($forms[$nextIndex])) {
	header("Location: register.php");
	exit();
}

// Clear the lists if necessary
if ($formIndex == 2) {
	if (!is_null($registrant->getAbstract())) {
		$registrant->getAbstract()->clearAuthors();
		$registrant->getAbstract()->clearAffiliations();
	}
}
if ($formIndex == 3) {
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
	$registrant->save($submitting); // Mark the submission as final if the next page is the thank-you page
} catch (DAOAuthException $e) {
	header("Location: {$forms[$formIndex]}?error_auth");
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

	header("Location: {$forms[$formIndex]}?$data_auth_query_string&$invalidFieldsQueryString#" . urlencode($invalidFields[0]));
	exit();
}

// If submitting, clear the cookies
if ($submitting) {
	setcookie('register_id', '', time() - 3600);
	setcookie('register_auth_key', '', time() - 3600);
}

// Go to the next page
if ($nextIndex == 'preview_abstract') {
	header("Location: {$forms[$nextIndex]}?id=" . urlencode($registrant->getAbstract()->getField('id')));
} else {
	header("Location: {$forms[$nextIndex]}?$data_auth_query_string");
}

// If submitting, send an email
if ($submitting) {
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
