<?php

require 'includes/lib.php';

$listLocation = 'register-list.php';
$successLocation = 'register-delete-success.php';

function showList() {
	header("Location: $listLocation");
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

header("Location: $successLocation?$queryString");

?>