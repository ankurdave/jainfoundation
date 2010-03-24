<?php

/**
 * Returns an assoc array with the registrant data from the DB, or null if it doesn't exist.
 */
function getRegistrant($id, $auth_key) {
	$db = connectToDB();
	
	$id_escaped = $db->real_escape_string($id);
	$auth_key_escaped = $db->real_escape_string($auth_key);
	
	$result = $db->query("SELECT * FROM abstract WHERE id='$id_escaped' AND auth_key='$auth_key_escaped'");
	return $result->fetch_assoc();
}

/*
 * Adds/updates a registrant in the DB.
 * @param array $data an assoc array with ('column' => 'value')
 * @param string $id the ID of an already-existing column. Will insert a new column if null
 * @param string $auth_key the auth key of an already-existing column. Will insert a new column if null
 */
function addRegistrant($data, $id = null, $auth_key = null) {
	$db = connectToDB();
	
	$data['final'] = $final;
	
	$update = !is_null($id) && !is_null($auth_key);
	if ($update) {
		// Use the given id and auth key
		$data['id'] = $id;
		$data['auth_key'] = $auth_key;
		
		// Check if the id and auth key are actually valid
		$query = $db->prepare("SELECT id FROM registrant WHERE id=? AND auth_key=?");
		$query->bind_param('is', $id, $auth_key);
		$query->execute();
		$query->store_result();
		if ($query->num_rows() < 1) {
			return false;
		}
	} else {
		// Create a new id and auth key
		$result = $db->query("SELECT MAX(id) FROM registrant");
		list($prevId) = $result->fetch_array();
		$data['id'] = $prevId + 1;
		$result->free();
		
		$data['auth_key'] = uniqid('', true); // TODO: use a real uuid for more security
	}

	// Calculate the total price
	if ($now <= strtotime('June 4, 2010')) {
		$postdoc_fee = 150;
		$other_fee = 250;
	} else {
		$postdoc_fee = 250;
		$other_fee = 350;
	}
	$base_fee = 0;
	if (!promo_code_valid($data['promo_code'])) {
		switch ($data['position']) {
			case "postdoc":
			case "grad_student":
			case "undergrad_student":
				$base_fee = $postdoc_fee;
				break;
			default:
				$base_fee = $other_fee;
		}
	}

	$gala_dinner_guest_fee = 0;
	if (!empty($data['meals_gala_dinner_numguests'])) {
		$gala_dinner_guest_fee = 50 * intval($data['meals_gala_dinner_numguests']);
	}

	$data['total_fee'] = $base_fee + $gala_dinner_guest_fee;

	
	// Build the list of columns
	$columns = explode(' ', 'id auth_key firstname lastname degree degree_other position position_other institution institution_profile institution_profile_other department street_address city state_province zip_postal_code country email phone fax submitting_abstract abstract_title local_attendee hotel_parking attendance_day1 attendance_day2 attendance_day3 attendance_day4 meals_day2_breakfast meals_day2_lunch meals_day2_lunch_entree meals_day3_breakfast meals_day3_lunch meals_day3_lunch_entree meals_day4_breakfast meals_day4_lunch meals_day4_lunch_entree meals_gala_dinner meals_gala_dinner_vegetarian meals_gala_dinner_guests meals_gala_dinner_numguests share_room gender arrival_date departure_date have_promo_code promo_code payment_type total_fee comments');
	$columns_string = join(', ', $columns);
	
	$columns_update = array_map('make_column_update_sql', $columns); // for the ON DUPLICATE KEY UPDATE clause
	$columns_update_string = join(', ', $columns_update);
	
	// Generate the "?, ?, ..." for the VALUES clause
	$column_placeholders = join(', ', array_fill(0, count($columns), '?'));
	
	// Generate the bind_param type argument
	$param_types = '';
	foreach ($columns as $col) {
		if ($col == 'id' || $col == 'total_fee') {
			$type = 'i';
		} else {
			$type = 's';
		}
		$param_types .= $type;
	}
	
	// Store the data in the DB
	$query = $db->prepare("INSERT INTO registrant ($columns_string) VALUES ($column_placeholders) ON DUPLICATE KEY UPDATE $columns_update_string");
	call_user_func_array(array(&$query, 'bind_param'), array_merge(array($param_types), assoc_array_slice($columns, $data)));
	
	$success = $query->execute();
	
	// Return the auth data
	if ($success) {
		return assoc_array_filter(array('id', 'auth_key'), $data);
	} else {
		return $success;
	}
}

/*
 * Checks if the given promotional code is valid. Not case sensitive.
 */
function promo_code_valid($code) {
	return strtoupper($code) == 'JF2010AS';
}

?>
