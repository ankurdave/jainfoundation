<?php
	require 'lib.php';
	
	$db = connectToDB();
	
	$query = $db->prepare('SELECT name, email, phone FROM person');
	$query->execute();
	$query->bind_result($name, $email, $phone);
	
	// TODO: Use XLS format, with PHPExcel: http://phpexcel.net/
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=registrations.csv');
?>
Name, Email, Phone
<?php while ($query->fetch()) {
	// This assumes the phone is stored as 10 pure digits. TODO: validate it.
	$phone = preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '(\1) \2-\3', $phone);
?>
<?php echo join(',', array(csv_encode($name), csv_encode($email), csv_encode($phone))), "\n" ?>
<?php } ?>
<?php $query->close(); ?>
