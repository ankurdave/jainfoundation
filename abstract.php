<?php
	require 'lib.php';
	
	// TODO: have this form save your data in case of error
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="style.css">

<script type="text/javascript">
	// See http://simonwillison.net/2004/May/26/addLoadEvent/
	function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
			if (oldonload) {
				oldonload();
			}
			func();
		}
		}
	}
	
	function addLabel(id, label) {
		if (document.getElementById(id).value === '' || document.getElementById(id).value === label) {
			document.getElementById(id).value = label;
			document.getElementById(id).style.color = 'gray';
		}
	}
	
	function clearLabel(id, label) {
		if (document.getElementById(id).value === '' || document.getElementById(id).value === label) {
			document.getElementById(id).value = '';
			document.getElementById(id).style.color = '';
		}
	}

	function handleLabel(id, label) {
		addLabel(id, label);
		document.getElementById(id).onblur = function() { addLabel(id, label) };
		document.getElementById(id).onfocus = function() { clearLabel(id, label) };
	}
	
	addLoadEvent(function() {
			handleLabel('firstname', 'First');
			handleLabel('middlename', 'Middle');
			handleLabel('lastname', 'Last');
			handleLabel('degree', 'Degree (MD, PhD, etc.)');
		});
</script>

<title>Submit an Abstract &ndash; Jain Foundation</title>
</head>

<body>
<div id="container">

<h1>Submit an Abstract</h1>

<?php include 'menu.inc.php' ?>

<?php if (isset($_GET['error_general'])) { ?>
	<p class="error">Something bad happened!</p>
<?php } ?>

<form action="register-submit" method="post">
	<table>
		<tr>
			<td>Name:</td>
			<td>
				<input type="text" name="firstname" id="firstname" <?php if (isset($_GET['error_firstname'])) { ?> class="error" <?php } ?>/>
				<input type="text" name="middlename" id="middlename" <?php if (isset($_GET['error_middlename'])) { ?> class="error" <?php } ?>/>
				<input type="text" name="lastname" id="lastname" <?php if (isset($_GET['error_lastname'])) { ?> class="error" <?php } ?>/>
				<input type="text" name="degree" id="degree" <?php if (isset($_GET['error_degree'])) { ?> class="error" <?php } ?>/>
			</td>
		</tr>
		<tr>
			<td>Email address:</td>
			<td><input type="text" name="email"/></td>
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
