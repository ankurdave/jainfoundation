<?php

require 'includes/lib.php';

$db = connectToDB();

$form_location = 'register.php';

// Load the abstract using the DAO
try {
	if (isset($_GET['id'])) {
		$abstract = new AbstractDAO($db, $_GET['id']);
	} else {
		header("Location: $form_location");
		exit;
	}
} catch (DAOException $e) {
	header("Location: $form_location");
	exit;
}

// Output the image
header("Content-Type: " . urlencode($abstract->getField('picture_mimetype')));

echo $abstract->getField('picture_data');

?>