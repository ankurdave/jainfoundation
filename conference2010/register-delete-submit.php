<?php

require 'includes/lib.php';

$successLocation = 'register-list.php';

function showList() {
	header("Location: register-list.php");
	exit;
}

$db = connectToDB();
if (isset($_GET['id'])) {
	try {
		$registrant = new RegistrantDAO($db, $_GET['id']);
	} catch (DAOAuthException $e) {
		showList();
	}
} else {
	showList();
}

$queryString = 'id=' . urlencode($_GET['id']);

try {
	$registrant->delete();
} catch (DAOAuthException $e) {
	showList();
}

header("Location: $successLocation");

?>