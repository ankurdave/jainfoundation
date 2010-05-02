<?php

require 'includes/lib.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=abstract-submission-info.csv");
// IE has a bug that breaks downloads from SSL sites with the no-cache header set (see http://support.microsoft.com/kb/812935). So we must clear the caching header.
header('Pragma:');

print xlsBegin();

$db = connectToDB();
$abstracts = AbstractDAO::loadAll($db, array('final' => 1));

include 'includes/abstract-export-fields.php';

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
