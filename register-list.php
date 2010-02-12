<?php
	require 'includes/lib.php';
	
	$db = connectToDB();
	
	$query = $db->prepare('SELECT name, email, phone FROM person');
	$query->execute();
	$query->bind_result($name, $email, $phone);
	
	printHeader(array('title' => 'List Registrations'));
?>

<h1>Registration Form Demo</h1>

<?php include 'includes/menu.inc.php' ?>

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
		<td><?php echo print_html($name) ?></td>
		<td><?php echo print_html($email) ?></td>
		<td><?php echo print_html($phone) ?></td>
	</tr>
<?php } ?>
<?php $query->close(); ?>
</table>

<?php
	printFooter();
?>
