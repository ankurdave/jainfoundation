<?php

require 'includes/lib.php';

passwordProtect('Conference pages', array('jainfoundation' => 'speed4jf'));

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=registrants.csv");
// IE has a bug that breaks downloads from SSL sites with the no-cache header set (see http://support.microsoft.com/kb/812935). So we must clear the caching header.
header('Pragma:');

print xlsBegin();

// Print the registrant info
$first = true;
$registrants = RegistrantDAO::getAll(connectToDB(), array('final' => 1));
foreach ($registrants as $registrant) {
	$fields = $registrant->getFields();
	unset($fields['auth_key']);

	// Add the gala guest info
	$i = 1;
	$galaGuestInfo = array();
	foreach ($registrant->getGalaGuests() as $galaGuest) {
		$galaGuestInfo[] = "Guest $i: " . $galaGuest->getField('vegetarian');
		$i++;
	}
	// Insert it into the appropriate place in the field list
	$fields = array_insert_after($fields, 'meals_gala_dinner_numguests', array('Gala Guest Vegetarian Options' => join(", ", $galaGuestInfo)));

	// Print the header the first time around
	if ($first) {
		print xlsWriteRow(array_keys($fields));
		$first = false;
	}

	// Print the row
	print xlsWriteRow(array_values($fields));
}

?>
