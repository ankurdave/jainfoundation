<?php

require 'includes/lib.php';

$db = connectToDB();

$successLocation = 'abstract-list.php';

function showList() {
	header("Location: abstract-list.php");
	exit;
}

if (isset($_GET['id'])) {
	try {
		$abstract = new AbstractDAO($db, $_GET['id']);
	} catch (DAOAuthException $e) {
		showList();
	}
} else {
	showList();
}

$queryString = 'id=' . urlencode($_GET['id']);

try {
	$abstract->delete();
} catch (DAOAuthException $e) {
	showList();
}

header("Location: $successLocation");

?>