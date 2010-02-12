<?php
	include 'includes/lib.php';
	
	$form_location = 'abstract';
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		header("Location: $form_location");
		exit;
	}
	
	printHeader(array('title' => 'Submit an Abstract'));
?>

<h1>Submit an Abstract</h1>

<?php include 'menu.inc.php' ?>

<p>Your abstract was successfully submitted (<a href="abstract-show?id=<?php echo urlencode($id) ?>">permalink</a>).</p>

<?php
	printFooter();
?>
