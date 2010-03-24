<?php
	require 'includes/lib.php';
	
	$db = connectToDB();
	$result = $db->query('SELECT * FROM registrant');
	
	header("Content-Type: text/csv");
	header("Content-Disposition: attachment; filename=registrants.csv");
	// IE has a bug that breaks downloads from SSL sites with the no-cache header set (see http://support.microsoft.com/kb/812935). So we must clear the caching header.
	header('Pragma:');

	print xlsBegin();
	
	$fields = $result->fetch_fields();
	$field_names = array();
	foreach ($fields as $field) {
		if ($field->name != 'auth_key') {
			$field_names[] = $field->name;
		}
	}
	print xlsWriteRow($field_names);
	
	while ($data = $result->fetch_assoc()) {
		unset($data['auth_key']); // don't print auth_key for security
		print xlsWriteRow(array_values($data));
	}

	$result->free();
?>
