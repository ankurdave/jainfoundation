<?php
	require 'lib.php';
	
	// TODO: have this form save your data in case of error
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

<h1>Submit an Abstract</h1>

<?php include 'menu.inc.php' ?>

<?php if (isset($_GET['error_general'])) { ?>
	<p class="error">Something bad happened!</p>
<?php } ?>

<form action="abstract-submit" method="post">
	<h2>Presenting/First Author</h2>
	<table>
		<tr>
			<td class="required">*</td>
			<td><label for="firstname">First name</label></td>
			<td><input type="text" name="firstname" id="firstname" <?php if (isset($_GET['error_firstname'])) { ?> class="error" <?php } ?>/></td>
		</tr>
		
		<tr>
			<td></td>
			<td><label for="middlename">Middle initial</label></td>
			<td><input type="text" name="middlename" id="middlename" <?php if (isset($_GET['error_middlename'])) { ?> class="error" <?php } ?>/></td>
		</tr>
		
		<tr>
			<td class="required">*</td>
			<td><label for="lastname">Last name</label></td>
			<td><input type="text" name="lastname" id="lastname" <?php if (isset($_GET['error_lastname'])) { ?> class="error" <?php } ?>/></td>
		</tr>
		
		<tr>
			<td class="required">*</td>
			<td><label for="degree">Degree</label></td>
			<td><input type="text" name="degree" id="degree" <?php if (isset($_GET['error_degree'])) { ?> class="error" <?php } ?>/>
				(MD, PhD, etc.)</td>
		</tr>
	</table>
	
	<p><input type="submit" name="submitted" value="Submit"></p>
</form>


</div>
</body>
</html>
