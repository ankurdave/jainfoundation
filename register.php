<?php
	require 'includes/lib.php';
	
	if (isset($_GET['error_name'])) {
		$error_name = true;
	}
	if (isset($_GET['error_email'])) {
		$error_email = true;
	}
	if (isset($_GET['error_phone'])) {
		$error_phone = true;
	}
	if (isset($_GET['error_general'])) {
		$error_general = true;
	}
	
	// TODO: have this form save your data in case of error
	
	printHeader(array('title' => 'Register'));
?>

<h1>Register</h1>

<?php include 'includes/menu.inc.php' ?>

<?php if ($error_general) { ?><p class="error">Something bad happened!</p><?php } ?>

<form action="register-submit.php" method="post">
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

<?php
	printFooter();
?>
