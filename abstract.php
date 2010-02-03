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
		<tr <?php echo get_error_style('firstname') ?>>
			<td class="required">*</td>
			<td><label for="firstname">First name</label></td>
			<td><input type="text" name="firstname" id="firstname" />
				<?php echo get_error_text('firstname') ?></td>
		</tr>
		
		<tr <?php echo get_error_style('middlename') ?>>
			<td></td>
			<td><label for="middlename">Middle initial</label></td>
			<td><input type="text" name="middlename" id="middlename" />
				<?php echo get_error_text('middlename') ?></td>
		</tr>
		
		<tr <?php echo get_error_style('lastname') ?>>
			<td class="required">*</td>
			<td><label for="lastname">Last name</label></td>
			<td><input type="text" name="lastname" id="lastname" />
				<?php echo get_error_text('lastname') ?></td>
		</tr>
		
		<tr <?php echo get_error_style('degree') ?>>
			<td class="required">*</td>
			<td><label for="degree">Degree</label></td>
			<td><input type="text" name="degree" id="degree" />
				(MD, PhD, etc.<?php echo get_error_text('degree', '; required') ?>)</td>
		</tr>
	</table>
	
	<p><input type="submit" name="submitted" value="Submit"></p>
</form>


</div>
</body>
</html>
