<?php

/*
 * Returns an assoc array with the abstract data from the DB, or null if it doesn't exist.
 */
function getAbstract($id) {
	$db = connectToDB();
	
	$id_escaped = $db->real_escape_string($id);
	
	$result = $db->query("SELECT * FROM abstract WHERE id='$id_escaped'");
	return $result->fetch_assoc();
}

/*
 * Adds/updates an abstract in the DB.
 * @param array $data an assoc array with ('column' => 'value')
 * @param boolean $final whether or not to mark the row as final and submitted in the DB
 * @param string $id the ID of an already-existing column. Will insert a new column if null
 * @param string $auth_key the auth key of an already-existing column. Will insert a new column if null
 */
function addAbstract($data, $final = false, $id = null, $auth_key = null) {
	$db = connectToDB();
	
	$data['final'] = $final;
	
	$update = !is_null($id) && !is_null($auth_key);
	if ($update) {
		// Use the given id and auth key
		$data['id'] = $id;
		$data['auth_key'] = $auth_key;
		
		// Check if the id and auth key are actually valid
		$query = $db->prepare("SELECT id FROM abstract WHERE id=? AND auth_key=?");
		$query->bind_param('is', $id, $auth_key);
		$query->execute();
		$query->store_result();
		if ($query->num_rows() < 1) {
			return false;
		}
	} else {
		// Create a new id and auth key
		$result = $db->query("SELECT MAX(id) FROM abstract");
		list($prevId) = $result->fetch_array();
		$data['id'] = $prevId + 1;
		$result->free();
		
		$data['auth_key'] = uniqid('', true); // TODO: use a real uuid for more security
	}
	
	// Set up the picture data for uploading
	$data['picture_data'] = null;
	
	// Build the list of columns
	$column_names = explode(', ', 'id, auth_key, picture_mimetype, picture_data, firstname, middlename, lastname, degree, department, institution, street_address, city, state_province, zip_postal_code, country, phone, fax, email, author_status, author_status_other, degree_year, abstract_category, abstract_category_other, presentation_type, abstract_title, abstract_body, comments, final');
	
	$affiliations = array();
	for ($i = 1; $i <= 8; $i++) {
		$affiliations[] = "affiliation_$i";
	}
	
	$authors = array();
	for ($i = 1; $i <= 8; $i++) {
		$authors[] = "author_{$i}_firstname";
		$authors[] = "author_{$i}_middlename";
		$authors[] = "author_{$i}_lastname";
		$authors[] = "author_{$i}_affiliation";
	}
	
	$columns = array_merge($column_names, $affiliations, $authors);
	$columns_string = join(', ', $columns);
	
	$columns_update = array_map('make_column_update_sql', $columns); // for the ON DUPLICATE KEY UPDATE clause
	$columns_update_string = join(', ', $columns_update);
	
	// Generate the "?, ?, ..." for the VALUES clause
	$column_placeholders = join(', ', array_fill(0, count($columns), '?'));
	
	// Generate the bind_param type argument
	$param_types = '';
	foreach ($columns as $col) {
		if ($col == 'id' || $col == 'final') {
			$type = 'i';
		} else if ($col == 'picture_data') {
			$type = 'b';
		} else {
			$type = 's';
		}
		$param_types .= $type;
	}
	
	// Store the data in the DB
	$query = $db->prepare("INSERT INTO abstract ($columns_string) VALUES ($column_placeholders) ON DUPLICATE KEY UPDATE $columns_update_string");
	call_user_func_array(array(&$query, 'bind_param'), array_merge(array($param_types), assoc_array_slice($columns, $data)));
	
	// Store the picture to the DB
	$filehandle = @fopen($data['picture_tmpname'], 'r');
	if ($filehandle) {
		$picture_data_col_number = array_search('picture_data', $columns);
		while (!feof($filehandle)) {
			$query->send_long_data($picture_data_col_number, fread($filehandle, 8192));
		}
		fclose($filehandle);
	}
	
	$success = $query->execute();
	
	// Return the row data
	if ($success) {
		return assoc_array_filter(array('id', 'auth_key'), $data);
	} else {
		return $success;
	}
}

?>
