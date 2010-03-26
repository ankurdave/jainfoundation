<?php

/**
 * Data access object for an abstract.
 */
class Abstract {
	private $db;
	private $data;
	
	/**
	 * Creates a new abstract.
	 */
	function __construct() {
		$this->db = connectToDB();
	}
	
	/**
	 * Loads the existing abstract with the given ID.
	 */
	function __construct($id) {
		$this->db = connectToDB();
		
		$id_escaped = $this->db->real_escape_string($id);
		$result = $this->db->query("SELECT * FROM abstract WHERE id='$id_escaped'");
		$this->data = $result->fetch_assoc();
	}
	
	/**
	 * Gets the current value of the field with the given name.
	 */
	function getField($fieldName) {
		return $this->data[$fieldName];
	}
	
	/**
	 * Sets the value of the field with the given name.
	 */
	function setField($fieldName, $fieldValue) {
		$this->data[$fieldName] = $fieldValue;
	}
	
	/**
	 * Saves the abstract to the database. Creates a new abstract if id and auth_key are set, otherwise updates the existing abstract with the given id.
	 * 
	 * Throws an exception if id and auth_key are set but invalid (do not exist in the database).
	 */
	function save() {
		if (!checkIdAuthKey()) {
			throw new Exception('Invalid ID and auth key');
		}
		
		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('abstract');
		foreach ($data as $col => $val) {
			$query->setColumn($col, $val, getColumnType($col));
		}
		
		// Run it
		$query->execute();
	}
	
	private function getColumnType($col) {
		if ($col == 'id' || $col == 'final') {
			return 'i';
		} else if ($col == 'picture_data') {
			return 'file';
		} else {
			return 's';
		}
	}
	
	/**
	 * Ensures a valid id and auth_key. If they are null, creates a new id and auth_key, and returns true. If they are set, checks if they are valid (whether or not they exist in the database). If valid, returns true; otherwise returns false.
	 */
	private function checkIdAuthKey() {
		$update = !is_null($this->data['id']) && !is_null($this->data['auth_key']);
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
