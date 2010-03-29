<?php
	require 'includes/lib.php';

	$db = connectToDB();
	
	$form_location = 'abstract.php';
	$show_location = 'abstract-show.php';
	$thankyou_location = 'abstract-success.php';
	
	// Load or create the DAO with id and auth_key
	if (isset($_GET['id']) && isset($_GET['auth_key'])) {
		$abstract = new AbstractDAO($_GET['id']);
		$abstract->setField('auth_key', $_GET['auth_key']);
	} else if (isset($_COOKIE['id']) && isset($_COOKIE['auth_key'])) {
		$abstract = new AbstractDAO($_COOKIE['id']);
		$abstract->setField('auth_key', $_COOKIE['auth_key']);
	} else {
		$abstract = new AbstractDAO();
	}
	
	// Send the rest of the fields to the DAO
	foreach ($_POST as $field => $val) {
		// If any field in $_POST is not a valid abstract field, setField will ignore it
		$abstract->setField($field, $val);
	}

	// Send the author and affiliation fields to the DAO
	$authors = array();
	foreach ($_POST as $field => $val) {
		if (empty($val)) {
			continue;
		}
		
		if (preg_match('/^author_(\d+)_(.*)$/i', $field, $matches)) {
			if ($authors[$matches[1]] === null) {
				$authors[$matches[1]] = new AbstractAuthorDAO($db);
			}

			$authors[$matches[1]]->setField($matches[2], $val);
		}
	}
	$abstract->clearAuthors();
	foreach ($authors as $author) {
		$abstract->addAuthor($author);
	}

	$affiliations = array();
	foreach ($_POST as $field => $val) {
		if (empty($val)) {
			continue;
		}
		
		if (preg_match('/^affiliation_(\d+)$/i', $field, $matches)) {
			if ($affiliations[$matches[1]] === null) {
				$affiliations[$matches[1]] = new AbstractAffiliationDAO($db);
			}

			$affiliations[$matches[1]]->setField('affiliation', $val);
		}
	}
	$abstract->clearAffiliations();
	foreach ($affiliations as $affiliation) {
		$abstract->addAffiliation($affiliation);
	}
	
	// Send the uploaded picture to the DAO
	// Important: This MUST come after the $_POST import, otherwise it would be possible to set a POST field called 'picture_data' to an arbitrary file system path
	if (is_uploaded_file($_FILES['picture']['tmp_name']) && $_FILES['picture']['size'] <= 1000000) {
		$abstract->setField('picture_data', $_FILES['picture']['tmp_name']);
		$abstract->setField('picture_mimetype', $_FILES['picture']['type']);
	}
	
	// Save the DAO
	// This is before validation so that if there's an error, the user won't lose the data
	try {
		$abstract->save($_POST['action'] == 'Submit');
	} catch (AbstractAuthException $e) {
		header("Location: $form_location?error_auth");
		exit;
	}
	
	// Set cookies and GET string with id and auth_key so that if the user clicks the back button, he won't lose his data
	setcookie('id', $abstract->getField('id'));
	setcookie('auth_key', $abstract->getField('auth_key'));
	$data_auth_query_string = "id=" . urlencode($abstract->getField('id')) . "&auth_key=" . urlencode($abstract->getField('auth_key'));
	
	// Validate the data and redirect to the form if it's wrong
	$invalidFields = $abstract->validate();
	if (count($invalidFields) > 0) {
		function makeFieldErrorString($field) {
			return urlencode("error_$field");
		}
		
		$invalidFieldsQueryString = join('&', array_map('makeFieldErrorString', $invalidFields));
		
		header("Location: $form_location?$data_auth_query_string&$invalidFieldsQueryString#" . urlencode($invalidFields[0]));
		exit();
	}
	
	// Send the user to the appropriate page
	if ($_POST['action'] == 'Submit') {
		// Clear the id and auth_key cookies, because now the user has submitted his abstract already.
		setcookie('id', '', time() - 3600);
		setcookie('auth_key', '', time() - 3600);
		
		// Show a thank-you page
		header("Location: $thankyou_location?$data_auth_query_string");
	} else {
		// Show the abstract preview
		header("Location:$show_location?$data_auth_query_string");
	}
?>
