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

	// Print the registrant info
	$first = true;
	$registrants = RegistrantDAO::getAll(connectToDB());
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
		$fields["Gala Guest Vegetarian Options"] = join(", ", $galaGuestInfo);

		// Print the header the first time around
		if ($first) {
			print xlsWriteRow(array_keys($fields));
			$first = false;
		}

		// Print the row
		print xlsWriteRow(array_values($fields));
	}
?>
