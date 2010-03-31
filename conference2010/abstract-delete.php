<?php
	require 'includes/lib.php';

	$submitLocation = 'abstract-delete-submit.php';

	function showList() {
		header("Location: abstract-list.php");
		exit;
	}

	if (isset($_GET['id'])) {
		try {
			$abstract = new AbstractDAO($_GET['id']);
		} catch (DAOAuthException $e) {
			showList();
		}
	} else {
		showList();
	}

	$queryString = 'id=' . urlencode($_GET['id']);

	printHeader(array('title' => 'Conference 2010 | Delete Abstract'));
?>
<h1>Delete Abstract</h1>

<form action="<?php echo $submitLocation . '?' . $queryString ?>" method="POST">

<p>Are you sure you want to delete <strong>abstract #<?php echo print_html($abstract->getField('id')) ?> ("<?php echo print_html($abstract->getField('abstract_title')) ?>" by <?php echo print_html($abstract->getField('firstname') . ' ' . $abstract->getField('lastname')) ?>)</strong>?</p>

<p><input type="submit" value="Delete" /></p>

</form>

<?php
	printFooter();
?>