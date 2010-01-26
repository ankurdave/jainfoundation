<?php
	require 'lib.php';
	
	if (!isset($_POST['submitted'])) {
		header('Location:register');
		exit;
	}
	if (empty($_POST['name'])) {
		header('Location:register?error_name');
		exit;
	}
	if (empty($_POST['email'])) {
		header('Location:register?error_email');
		exit;
	}
	if (!(empty($_POST['phone']) || preg_match('/\d/', $_POST['phone']) != 10)) {
		header('Location:register?error_phone');
		exit;
	}
	
	require_once 'lib.php';
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
	$success = addPerson($name, $email, $phone);
	
	if ($success) {
		header('Location:register-success');
	} else {
		header('Location:register?error_general');
	}
?>
