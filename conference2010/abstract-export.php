<?php

require 'includes/lib.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=abstract-submission-info.csv");
// IE has a bug that breaks downloads from SSL sites with the no-cache header set (see http://support.microsoft.com/kb/812935). So we must clear the caching header.
header('Pragma:');

print xlsBegin();

$db = connectToDB();
$abstracts = AbstractDAO::loadAll($db);

// Assoc array of field name and whether the field is in Abstract (false) or Registrant (true).
$fields = array(
	'id' => false,
	'firstname' => true,
	'middlename' => true,
	'lastname' => true,
	'degree' => true,
	'department' => true,
	'institution' => true,
	'street_address' => true,
	'street_address_2' => true,
	'city' => true,
	'state_province' => true,
	'zip_postal_code' => true,
	'country' => true,
	'phone' => true,
	'fax' => true,
	'email' => true,
	'author_status' => true,
	'degree_year' => true,
	'abstract_category' => false,
	'abstract_category_other' => false,
	'presentation_type' => false,
	'abstract_title' => false,
	'comments' => false,
);

print xlsWriteRow(array_keys($fields));

foreach ($abstracts as $abstract) {
	foreach ($fields as $fieldName => $inRegistrant) {
		if ($inRegistrant) {
			print xlsWriteCell($abstract->getRegistrant()->getField($fieldName));
		} else {
			print xlsWriteCell($abstract->getField($fieldName));
		}
		print xlsWriteCellSeparator();
	}
	print xlsWriteRowTerminator();
}

?>
