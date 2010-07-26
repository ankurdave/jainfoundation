<?php
//	error_reporting(E_ALL);
require 'includes/lib.php';

$db = connectToDB();
	
$submit_location = 'register-submit.php';
	
// Set the default values
$registrant = new RegistrantDAO($db);
	
// Load the saved values from the DAO, if any
try {
	if (isset($_GET['id'])) {
		$registrant = new RegistrantDAO($db, $_GET['id']);
		$registrant->setField('auth_key', $_GET['auth_key']);
	} else if (isset($_COOKIE['register_id'])) {
		$registrant = new RegistrantDAO($db, $_COOKIE['register_id']);
		$registrant->setField('auth_key', $_COOKIE['register_auth_key']);
	}
} catch (DAOAuthException $e) { }

// Build the query string
$data_auth_query_string_elements = array(
	'id' => $registrant->getField('id'),
	'auth_key' => $registrant->getField('auth_key'),
	'edit' => urlencode($_GET['edit']),
);
$data_auth_query_string = buildQueryString($data_auth_query_string_elements);

printHeader(array(
	'title' => 'Conference 2010 | Meeting Registration and Abstract Submission',
	'scripts' => array(
		$Config['URLPath'] . '/js/jquery.validate.js',
		'js/register-common.js',
		'js/register.js',
	),
	'page_nav_id' => 'register'
));
?>

<?php include 'includes/conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Meeting Registration and Abstract Submission</h2>

<p>Registration is now closed. Please email <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org</a> if you have any questions, requests or concerns. Thank you.</p>

<?php
	printFooter();
?>
