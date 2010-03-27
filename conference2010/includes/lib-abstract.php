<?php

/**
 * Data access object for an abstract.
 */
class AbstractDAO {
	private $db;
	private $data;
	private $columnTypes = array(
		'id' => array('i', false),
		'auth_key' => array('s', false),
		'picture_mimetype' => array('s', false),
		'picture_data' => array('file', false),
		'firstname' => array('s', true),
		'middlename' => array('s', false),
		'lastname' => array('s', true),
		'degree' => array('s', true),
		'department' => array('s', false),
		'institution' => array('s', true),
		'street_address' => array('s', true),
		'city' => array('s', true),
		'state_province' => array('s', false),
		'zip_postal_code' => array('s', true),
		'country' => array('s', true),
		'phone' => array('s', true),
		'fax' => array('s', false),
		'email' => array('s', true),
		'author_status' => array('s', true),
		'degree_year' => array('s', false),
		'abstract_category' => array('s', true),
		'abstract_category_other' => array('s', false),
		'presentation_type' => array('s', true),
		'abstract_title' => array('s', true),
		'abstract_body' => array('s', true),
		'affiliation_1' => array('s', true),
		'affiliation_2' => array('s', false),
		'affiliation_3' => array('s', false),
		'affiliation_4' => array('s', false),
		'affiliation_5' => array('s', false),
		'affiliation_6' => array('s', false),
		'affiliation_7' => array('s', false),
		'affiliation_8' => array('s', false),
		'author_1_firstname' => array('s', true),
		'author_1_middlename' => array('s', false),
		'author_1_lastname' => array('s', true),
		'author_1_affiliation' => array('s', true),
		'author_2_firstname' => array('s', false),
		'author_2_middlename' => array('s', false),
		'author_2_lastname' => array('s', false),
		'author_2_affiliation' => array('s', false),
		'author_3_firstname' => array('s', false),
		'author_3_middlename' => array('s', false),
		'author_3_lastname' => array('s', false),
		'author_3_affiliation' => array('s', false),
		'author_4_firstname' => array('s', false),
		'author_4_middlename' => array('s', false),
		'author_4_lastname' => array('s', false),
		'author_4_affiliation' => array('s', false),
		'author_5_firstname' => array('s', false),
		'author_5_middlename' => array('s', false),
		'author_5_lastname' => array('s', false),
		'author_5_affiliation' => array('s', false),
		'author_6_firstname' => array('s', false),
		'author_6_middlename' => array('s', false),
		'author_6_lastname' => array('s', false),
		'author_6_affiliation' => array('s', false),
		'author_7_firstname' => array('s', false),
		'author_7_middlename' => array('s', false),
		'author_7_lastname' => array('s', false),
		'author_7_affiliation' => array('s', false),
		'author_8_firstname' => array('s', false),
		'author_8_middlename' => array('s', false),
		'author_8_lastname' => array('s', false),
		'author_8_affiliation' => array('s', false),
		'final' => array('i', false),
		'author_status_other' => array('s', false),
		'comments' => array('s', false),
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
		if (array_key_exists($fieldName, $this->columnTypes)) {
			$this->data[$fieldName] = $fieldValue;
		}
	}
	
	/**
	 * Saves the abstract to the database. Creates a new abstract if id and auth_key are set, otherwise updates the existing abstract with the given id.
	 * 
	 * Throws an exception if id and auth_key are set but invalid (do not exist in the database).
	 */
	function save() {
		// Check the preconditions
		if (!$this->checkIdAuthKey()) {
			throw new AbstractAuthException('Invalid ID or auth key');
		}
		if ($this->checkFinal()) {
			throw new AbstractAuthException('Abstract is marked as final');
		}
		
		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('abstract');
		foreach ($this->data as $col => $val) {
			$query->setColumn($col, $val, $this->columnTypes[$col][0]);
		}
		
		// Run it
		$query->execute();
	}
	
	/**
	 * Checks whether or not the given fields are valid. Returns an array of invalid fields. This array will be empty if all fields are valid.
	 */
	function validate() {
		$invalidFields = array();
		
		// Check if all required fields are present
		foreach ($this->columnTypes as $colName => $colInfo) {
			// If the column is required, make sure it's non-empty in $this->data
			if ($colInfo[1]) {
				if (empty($this->data[$colName])) {
					$invalidFields[] = $colName;
				}
			}
		}
		
		return $invalidFields;
	}
	
	/**
	 * Returns an associative array of the fields in the abstract.
	 */
	function getFields() {
		return $this->data;
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
	
	/**
	 * Checks whether or not this abstract is marked as 'final' in the database.
	 */
	private function checkFinal() {
		return !is_null($this->data['id']) && ($this->data['final'] == 1);
	}
}

class AbstractAuthException extends Exception { }

?>
