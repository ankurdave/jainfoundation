<?php

require 'includes/lib.php';

$db = connectToDB();

$form_location = 'register.php';

// Load the abstract using the DAO
try {
	if (isset($_GET['id'])) {
		$abstract = new AbstractDAO($db, $_GET['id']);
	} else if (isset($_COOKIE['id'])) {
		$abstract = new AbstractDAO($db, $_COOKIE['id']);
	} else {
		header("Location: $form_location");
		exit;
	}
} catch (DAOAuthException $e) {
	header("Location: $form_location");
	exit;
}

// Output a Word document with HTML in it
// See http://stackoverflow.com/questions/124959/create-word-document-using-php-in-linux#answer-125009
header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=abstract-" . urlencode($abstract->getField('id')) . ".doc");

printAbstractHead();
printAbstractBody($abstract);
printAbstractFoot();

?>
