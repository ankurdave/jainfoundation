<?php
	require 'includes/lib.php';

	$submitLocation = 'register-delete-submit.php';

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

	printHeader(array('title' => 'Conference 2010 | Delete Registrant'));
?>
<h1>Delete Registrant</h1>

<form action="<?php echo $submitLocation . '?' . $queryString ?>" method="POST">

<p>Are you sure you want to delete <strong>registrant #<?php echo print_html($registrant->getField('id')) ?> (<?php echo print_html($registrant->getField('firstname') . ' ' . $registrant->getField('lastname')) ?>)</strong>?</p>

<p><input type="submit" value="Delete" /></p>

</form>

<?php
	printFooter();
?>