<?php
	require 'includes/lib.php';
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
	
	if (!isset($_POST['submitted'])) {
		header('Location:register');
		exit;
	}
	if (empty($name)) {
		header('Location:register?error_name');
		exit;
	}
	if (empty($email)) {
		header('Location:register?error_email');
		exit;
	}
	if (!empty($phone) && strlen($phone) != 10) {
		header('Location:register?error_phone');
		exit;
	}
	
	$success = addPerson($name, $email, $phone);	
	if ($success) {
		header('Location:register-success');
	} else {
		header('Location:register?error_general');
		exit;
	}
?>
