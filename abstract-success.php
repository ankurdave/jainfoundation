<?php
	$form_location = 'abstract';
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		header("Location: $form_location");
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="style.css">
<title>Submit an Abstract &ndash; Jain Foundation</title>
</head>

<body>
<div id="container">
<h1>Submit an Abstract &ndash; Jain Foundation</h1>

<?php include 'menu.inc.php' ?>

<p>Your abstract was successfully submitted (<a href="abstract-show?id=<?php echo urlencode($id) ?>">permalink</a>).</p>

</div>
</body>
</html>
