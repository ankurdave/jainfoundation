<?php
	require 'lib.php';
	
	if (isset($_GET['error_name'])) {
		$error_name = true;
	}
	if (isset($_GET['error_email'])) {
		$error_password = true;
	}
	if (isset($_GET['error_phone'])) {
		$error_phone = true;
	}
	if (isset($_GET['error_general'])) {
		$error_general = true;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="style.css">
<title>Registration Form Demo &ndash; Jain Foundation</title>
</head>

<body>
<div id="container">

<h1>Registration Form Demo</h1>

<div id="nav">
	<ul>
		<li><a href="index">Register</a></li>
		<li><a href="list">List registrations</a></li>
	</ul>
</div>

<?php if ($error_general) { ?><p class="error">Something bad happened!</p><?php } ?>

<form action="register-submit" method="post">
	<table>
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name"/></td>
			<td<?php if ($error_name) { ?> class="error" <?php } ?>>(required)</td>
		</tr>
		<tr>
			<td>Email address:</td>
			<td><input type="text" name="email"/></td>
			<td<?php if ($error_email) { ?> class="error" <?php } ?>>(required)</td>
		</tr>
		<tr>
			<td>Phone number:</td>
			<td><input type="text" name="phone"/></td>
			<td <?php if ($error_phone) { ?> class="error" <?php } ?>>(must have 10 digits)</td>
		</tr>
	</table>
	
	<p><input type="submit" name="submitted" value="Submit"></p>
</form>


</div>
</body>
</html>
