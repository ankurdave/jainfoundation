<?php
	require 'lib.php';
	
	$db = connectToDB();
	
	$query = $db->prepare('SELECT name, email, phone FROM person');
	$query->execute();
	$query->bind_result($name, $email, $phone);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="style.css">
<style type="text/css">
	#container {
		margin: 0;
		max-width: none;
	}
	table {
		border-spacing: 0.3em;
	}
</style>
<title>Registration Form Demo &ndash; Jain Foundation</title>
</head>

<body>
<div id="container">

<h1>Registration Form Demo</h1>

<div id="nav">
	<ul>
		<li><a href="index">Register</a></li>
		<li><a href="export">Export registrations</a></li>
	</ul>
</div>

<table>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
	</tr>
<?php while ($query->fetch()) {
	// This assumes the phone is stored as 10 pure digits. TODO: validate it.
	$phone = preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '(\1) \2-\3', $phone);
?>
	<tr>
		<td><?php echo htmlentities($name) ?></td>
		<td><?php echo htmlentities($email) ?></td>
		<td><?php echo htmlentities($phone) ?></td>
	</tr>
<?php } ?>
<?php $query->close(); ?>
</table>
</div>
</body>
</html>
