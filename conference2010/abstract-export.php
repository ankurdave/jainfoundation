<?php
	require 'includes/lib.php';
	
	$db = connectToDB();
	$result = $db->query('SELECT id, firstname, middlename, lastname, degree, department, institution, street_address, street_address_2, city, state_province, zip_postal_code, country, phone, fax, email, author_status, degree_year, abstract_category, abstract_category_other, presentation_type, abstract_title, comments FROM abstract');
	
	header("Content-Type: text/csv");
	header("Content-Disposition: attachment; filename=abstract-submission-info.csv");
	// IE has a bug that breaks downloads from SSL sites with the no-cache header set (see http://support.microsoft.com/kb/812935). So we must clear the caching header.
	header('Pragma:');

	print xlsBegin();
	
	$fields = $result->fetch_fields();
	$field_names = array();
	foreach ($fields as $field) {
		$field_names[] = $field->name;
	}
	print xlsWriteRow($field_names);
	
	while ($data = $result->fetch_assoc()) {
		print xlsWriteRow(array_values($data));
	}

	$result->free();
?>
