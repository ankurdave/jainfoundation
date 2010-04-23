
	// Send the gala guest info to the DAO
	$galaGuests = array();
	foreach ($_POST as $field => $val) {
		if (empty($val)) {
			continue;
		}

		if (preg_match('/^meals_gala_dinner_guest_(\d+)_(.*)$/i', $field, $matches)) {
			if ($galaGuests[$matches[1]] === null) {
				$galaGuests[$matches[1]] = new RegistrantGalaGuestDAO($db);
			}

			$galaGuests[$matches[1]]->setField($matches[2], $val);
		}
	}
	$registrant->clearGalaGuests();
	foreach ($galaGuests as $galaGuest) {
		$registrant->addGalaGuest($galaGuest);
	}

	// Send the uploaded picture to the DAO
	// Important: This MUST come after the $_POST import, otherwise it would be possible to set a POST field called 'picture_data' to an arbitrary file system path
	if (is_uploaded_file($_FILES['picture']['tmp_name']) && $_FILES['picture']['size'] <= 1000000) {
		$abstract->setField('picture_data', $_FILES['picture']['tmp_name']);
		$abstract->setField('picture_mimetype', $_FILES['picture']['type']);
	}


	// Send an email
	include 'Mail.php';
	$registrantID = urlencode($registrant->getField('id'));
	$submitterName = print_html($registrant->getField('firstname')) . ' ' . print_html($registrant->getField('lastname'));
	$mail = Mail::factory('smtp', $Config['ConferenceNotificationEmail']);
	$headers = array(
		'From' => $Config['ConferenceNotificationEmail']['from'],
		'To' => $Config['ConferenceNotificationEmail']['to'],
		'Subject' => "Registration #$registrantID submitted by $submitterName",
	);
	$body = <<<EOT
Registration list: {$Config['FullURL']}/conference2010/register-list.php#registrant$registrantID

Registration export: {$Config['FullURL']}/conference2010/register-export.php
EOT;
	$mail->send($Config['ConferenceNotificationEmail']['to'], $headers, $body);
