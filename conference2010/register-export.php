<?php
	require 'includes/lib.php';

	function notAuthKey($key) {
		return $key != 'auth_key';
	}
	
	header("Content-Type: text/csv");
	header("Content-Disposition: attachment; filename=registrants.csv");
	// IE has a bug that breaks downloads from SSL sites with the no-cache header set (see http://support.microsoft.com/kb/812935). So we must clear the caching header.
	header('Pragma:');

	print xlsBegin();

	// Print the column headers
	$fieldNames = array_filter(array_keys($RegistrantDAO::columnTypes), 'notAuthKey');
	print xlsWriteRow($fieldNames);

	// Print the registrant info
	$registrants = RegistrantDAO::getAll(connectToDB());
	foreach ($registrants as $registrant) {
		$fields = $registrants->getFields();
		unset($fields['auth_key']);
		print xlsWriteRow(array_values($fields));
	}

	$result->free();
?>
