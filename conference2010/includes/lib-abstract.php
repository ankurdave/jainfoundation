<?php

/**
 * Data access object for an abstract.
 */
class AbstractDAO {
	private $db;
	private $data;
	private $columnTypes = array(
		'id' => 'i',
		'auth_key' => 's',
		'picture_mimetype' => 's',
		'picture_data' => 'file',
		'firstname' => 's',
		'middlename' => 's',
		'lastname' => 's',
		'degree' => 's',
		'department' => 's',
		'institution' => 's',
		'street_address' => 's',
		'city' => 's',
		'state_province' => 's',
		'zip_postal_code' => 's',
		'country' => 's',
		'phone' => 's',
		'fax' => 's',
		'email' => 's',
		'author_status' => 's',
		'degree_year' => 's',
		'abstract_category' => 's',
		'abstract_category_other' => 's',
		'presentation_type' => 's',
		'abstract_title' => 's',
		'abstract_body' => 's',
		'affiliation_1' => 's',
		'affiliation_2' => 's',
		'affiliation_3' => 's',
		'affiliation_4' => 's',
		'affiliation_5' => 's',
		'affiliation_6' => 's',
		'affiliation_7' => 's',
		'affiliation_8' => 's',
		'author_1_firstname' => 's',
		'author_1_middlename' => 's',
		'author_1_lastname' => 's',
		'author_1_affiliation' => 's',
		'author_2_firstname' => 's',
		'author_2_middlename' => 's',
		'author_2_lastname' => 's',
		'author_2_affiliation' => 's',
		'author_3_firstname' => 's',
		'author_3_middlename' => 's',
		'author_3_lastname' => 's',
		'author_3_affiliation' => 's',
		'author_4_firstname' => 's',
		'author_4_middlename' => 's',
		'author_4_lastname' => 's',
		'author_4_affiliation' => 's',
		'author_5_firstname' => 's',
		'author_5_middlename' => 's',
		'author_5_lastname' => 's',
		'author_5_affiliation' => 's',
		'author_6_firstname' => 's',
		'author_6_middlename' => 's',
		'author_6_lastname' => 's',
		'author_6_affiliation' => 's',
		'author_7_firstname' => 's',
		'author_7_middlename' => 's',
		'author_7_lastname' => 's',
		'author_7_affiliation' => 's',
		'author_8_firstname' => 's',
		'author_8_middlename' => 's',
		'author_8_lastname' => 's',
		'author_8_affiliation' => 's',
		'final' => 'i',
		'author_status_other' => 's',
		'comments' => 's',
	);
	
	/**
	 * Loads the existing abstract with the given ID. If $id is null, creates a new empty abstract.
	 */
	function __construct($id = null) {
		$this->db = connectToDB();
		
		if ($id !== null) {
			$id_escaped = $this->db->real_escape_string($id);
			$result = $this->db->query("SELECT * FROM abstract WHERE id='$id_escaped'");
			$row = $result->fetch_assoc();
			
			// Do not store auth_key for security
			// This prevents the following scenario:
			// $abstract = new AbstractDAO(100); // Loads abstract from DB, including auth_key
			// $abstract->setField('abstract_title', 'bogus');
			// $abstract->save(); // Checks auth_key, which will always be correct, since it was just loaded from the DB. Data has been modified without proper authentication!
			unset($row['auth_key']);
			
			$this->data = $row;
		}
	}
	
	/**
	 * Gets the current value of the field with the given name.
	 */
	function getField($fieldName) {
		return $this->data[$fieldName];
	}
	
	/**
	 * Sets the value of the field with the given name. If the field is not a valid column, does nothing.
	 */
	function setField($fieldName, $fieldValue) {
		if (defined($this->columnTypes[$fieldName])) {
			$this->data[$fieldName] = $fieldValue;
		}
	}
	
	/**
	 * Saves the abstract to the database. Creates a new abstract if id and auth_key are set, otherwise updates the existing abstract with the given id.
	 * 
	 * Throws an exception if id and auth_key are set but invalid (do not exist in the database).
	 */
	function save() {
		if (!$this->checkIdAuthKey()) {
			throw new Exception('Invalid ID or auth key');
		}
		
		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('abstract');
		foreach ($this->data as $col => $val) {
			$query->setColumn($col, $val, $this->columnTypes[$col]);
		}
		
		// Run it
		$query->execute();
	}

	/**
	 * Ensures a valid id and auth_key. If they are null, creates a new id and auth_key, and returns true. If they are set, checks if they are valid (whether or not they exist in the database). If valid, returns true; otherwise returns false.
	 */
	private function checkIdAuthKey() {
		$update = !is_null($this->data['id']);
		if ($update) {
			// Check if the id and auth key are actually valid
			$query = $this->db->prepare("SELECT id FROM abstract WHERE id=? AND auth_key=?");
			$query->bind_param('is', $this->data['id'], $this->data['auth_key']);
			$query->execute();
			$query->store_result();

			return $query->num_rows() > 0;
		} else {
			// Create a new id and auth key
			$result = $this->db->query("SELECT MAX(id) FROM abstract");
			list($prevId) = $result->fetch_array();
			$this->data['id'] = $prevId + 1;
			$result->free();
		
			$this->data['auth_key'] = uniqid('', true); // TODO: use a real uuid for more security
			return true;
		}
	}
}

?>
