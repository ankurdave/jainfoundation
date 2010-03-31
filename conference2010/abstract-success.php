<?php
	include 'includes/lib.php';
	
	$form_location = 'abstract.php';
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		header("Location: $form_location");
		exit;
	}
	
	printHeader(array('title' => 'Conference 2010 | Abstract Submission'));
?>

<?php include 'includes/conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Abstract Submission</h2>

<p>Your abstract was successfully submitted (<a href="abstract-show.php?id=<?php echo urlencode($id) ?>">permalink</a>). Please print a copy of this page for your records.</p>

<p>We will let you know if your abstract has been accepted by July 9th, 2010. Please follow the <a href="register.php">registration link</a> to begin registering for the Fourth Annual Dysferlin Conference.</p>

<p>If you have any questions or concerns, please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org</a>.</p>
</p>

<?php
	printFooter();
?>
