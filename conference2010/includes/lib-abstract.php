<?php

/**
 * Data access object for an abstract.
 */
class AbstractDAO {
	private $db;
	private $data;
	public static $columnTypes = array(
		'id' => array('i', false),
		'registrant_id' => array('i', false),
		'picture_mimetype' => array('s', false),
		'picture_data' => array('file', false),
		'abstract_category' => array('s', true),
		'abstract_category_other' => array('s', false),
		'presentation_type' => array('s', true),
		'abstract_title' => array('s', true),
		'abstract_body' => array('s', true),
		'final' => array('i', false),
		'comments' => array('s', false),
	);
	private $authors = array();
	private $affiliations = array();
	
	/**
	 * Loads the existing abstract with the given ID. If $id is null, creates a new empty abstract.
	 */
	function __construct($db, $id = null) {
		$this->db = $db;

		if ($id !== null) {
			$id_escaped = $this->db->real_escape_string($id);
			$result = $this->db->query("SELECT * FROM abstract WHERE id='$id_escaped'");
			if ($result->num_rows == 0) {
				throw new DAOAuthException("No such abstract");
			}
			
			$row = $result->fetch_assoc();
			
			// Copy the row data into the abstract fields
			// Use foreach and setField instead of a straight array copy because setField checks whether each column is a valid abstract entry. This drops any columns that are in the database but not valid for the DAO.
			foreach ($row as $key => $val) {
				$this->setField($key, $val);
			}
			
			// Load the associated authors and affiliations
			$this->authors = AbstractAuthorDAO::loadAssociated($this->db, $this->data['id']);
			$this->affiliations = AbstractAffiliationDAO::loadAssociated($this->db, $this->data['id']);
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
		if (array_key_exists($fieldName, self::$columnTypes)) {
			$this->data[$fieldName] = $fieldValue;
		}
		// TODO: warn using syslog if field does not exist
	}
	
	/**
	 * Returns the author at the given index. If it doesn't exist, creates a new one automatically.
	 */
	function getAuthor($index) {
		if (!isset($this->authors[$index])) {
			$this->authors[$index] = new AbstractAuthorDAO($this->db);
		}
		return $this->authors[$index];
	}

	/**
	 * Returns all authors.
	 */
	function getAuthors() {
		return $this->authors;
	}
	
	function clearAuthors() {
		$this->authors = array();
	}
	
	/**
	 * Returns the affiliation at the given index. If it doesn't exist, creates a new one automatically.
	 */
	function getAffiliation($index) {
		if (!isset($this->affiliations[$index])) {
			$this->affiliations[$index] = new AbstractAffiliationDAO($this->db);
		}
		return $this->affiliations[$index];
	}

	/**
	 * Returns all affiliations.
	 */
	function getAffiliations() {
		return $this->affiliations;
	}

	function clearAffiliations() {
		$this->affiliations = array();
	}
	
	/**
	 * Saves the abstract to the database. Creates a new abstract if id and auth_key are set, otherwise updates the existing abstract with the given id.
	 * 
	 * Throws an exception if id and auth_key are set but invalid (do not exist in the database).
	 */
	function save($finalize = false) {
		// Check the preconditions
		if (!$this->checkId()) {
			throw new DAOAuthException('Invalid ID');
		}
		if ($this->checkFinal()) {
			throw new DAOAuthException('Abstract is marked as final');
		}
		
		// Clear and reinsert the authors and affiliations
		AbstractAuthorDAO::deleteAssociated($this->db, $this->data['id']);
		foreach ($this->authors as $author) {
			$author->setField('abstract_id', $this->data['id']);
			$author->save();
		}

		AbstractAffiliationDAO::deleteAssociated($this->db, $this->data['id']);
		foreach ($this->affiliations as $affiliation) {
			$affiliation->setField('abstract_id', $this->data['id']);
			$affiliation->save();
		}

		// Set the 'final' field
		$this->data['final'] = $finalize;
		
		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('abstract');
		foreach ($this->data as $col => $val) {
			$query->setColumn($col, $val, self::$columnTypes[$col][0]);
		}
		
		// Run it
		$query->execute();
	}

	/**
	 * Deletes the abstract from the database. Throws an exception if id is invalid.
	 */
	function delete() {
		$query = $this->db->prepare("DELETE FROM abstract WHERE id=?");
		$query->bind_param('i', $this->data['id']);
		$query->execute();
		$query->store_result();

		if ($query->affected_rows != 1) {
			throw new DAOAuthException("Invalid ID");
		}

		// Delete the authors and affiliations from the database
		AbstractAuthorDAO::deleteAssociated($this->db, $this->data['id']);
		AbstractAffiliationDAO::deleteAssociated($this->db, $this->data['id']);
	}
	
	/**
	 * Checks whether or not the given fields are valid. Returns an array of invalid fields. This array will be empty if all fields are valid.
	 */
	function validate() {
		$invalidFields = array();
		
		// Check if all required fields are present
		foreach (self::$columnTypes as $colName => $colInfo) {
			// If the column is required, make sure it's non-empty in $this->data
			if ($colInfo[1]) {
				if (empty($this->data[$colName])) {
					$invalidFields[] = $colName;
				}
			}
		}
		
		// TODO: also check the authors and affiliations
		
		return $invalidFields;
	}
	
	/**
	 * Returns an associative array of the fields in the abstract.
	 */
	function getFields() {
		return $this->data;
	}

	/**
	 * Ensures a valid id. If it is null, creates a new id. If is is set, checks if it is valid (whether or not it exists in the database). If valid, returns true; otherwise returns false.
	 */
	private function checkId() {
		$update = !is_null($this->data['id']);
		if ($update) {
			// Check if the id and auth key are actually valid
			$query = $this->db->prepare("SELECT id FROM abstract WHERE id=?");
			$query->bind_param('i', $this->data['id']);
			$query->execute();
			$query->store_result();

			return $query->num_rows() > 0;
		} else {
			// Create a new id and auth key
			$result = $this->db->query("SELECT MAX(id) FROM abstract");
			list($prevId) = $result->fetch_array();
			$this->data['id'] = $prevId + 1;
			$result->free();
		
			return true;
		}
	}
	
	/**
	 * Checks whether or not this abstract is marked as 'final' in the database.
	 */
	private function checkFinal() {
		return !is_null($this->data['id']) && ($this->data['final'] == 1);
	}

	/**
	 * Returns the abstract associated with the given registrant ID.
	 */
	static function loadAssociated($db, $registrantId) {
		$registrantIdEscaped = $db->real_escape_string($registrantId);
		$result = $db->query("SELECT id FROM abstract WHERE registrant_id=$registrantIdEscaped");
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$dao = new AbstractDAO($db, $row['id']);
			return $dao;
		} else {
			return null;
		}
	}
}

class AbstractAuthorDAO {
	private $db;
	private $data;
	private static $columnTypes = array(
		'id' => array('i', false),
		'abstract_id' => array('i', true),
		'firstname' => array('s', true),
		'middlename' => array('s', false),
		'lastname' => array('s', true),
		'affiliations' => array('s', true),
	);
	
	function __construct($db) {
		$this->db = $db;
	}
	
	/**
	 * Saves the abstract author to the database. Creates a new author if id is set, otherwise updates the existing abstract with the given id.
	 */
	function save() {
		// Check the preconditions
		$this->checkId();
		
		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('abstract_author');
		foreach ($this->data as $col => $val) {
			$query->setColumn($col, $val, self::$columnTypes[$col][0]);
		}
		
		// Run it
		$query->execute();
	}

	/**
	 * Ensures a valid id. If it is null, creates a new id.
	 */
	private function checkId() {
		if (is_null($this->data['id'])) {
			// Create a new id
			$result = $this->db->query("SELECT MAX(id) FROM abstract_author");
			list($prevId) = $result->fetch_array();
			$this->data['id'] = $prevId + 1;
			$result->free();
		}
	}

	/**
	 * Returns an associative array of the fields in the abstract.
	 */
	function getFields() {
		return $this->data;
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
		if (array_key_exists($fieldName, self::$columnTypes)) {
			$this->data[$fieldName] = $fieldValue;
		}
		// TODO: warn using syslog if field does not exist
	}
	
	/**
	 * Returns an array of AbstractAuthorDAO that are associated with the given abstract.
	 */
	static function loadAssociated($db, $abstractId) {
		$abstractIdEscaped = $db->real_escape_string($abstractId);
		$result = $db->query("SELECT * FROM abstract_author WHERE abstract_id=$abstractIdEscaped ORDER BY id");
		
		$associated = array();
		while ($row = $result->fetch_assoc()) {
			$dao = new AbstractAuthorDAO($db);
			foreach ($row as $key => $val) {
				$dao->setField($key, $val);
			}
			
			$associated[] = $dao;
		}
		
		return $associated;
	}

	/**
	 * Deletes all the authors associated with the given abstract ID.
	 */
	static function deleteAssociated($db, $abstractId) {
		$query = $db->prepare("DELETE FROM abstract_author WHERE abstract_id=?");
		$query->bind_param('i', $abstractId);
		$query->execute();
	}
}

class AbstractAffiliationDAO {
	private $db;
	private $data;
	private static $columnTypes = array(
		'id' => array('i', false),
		'abstract_id' => array('i', true),
		'affiliation' => array('s', true),
	);
	
	function __construct($db) {
		$this->db = $db;
	}
	
	/**
	 * Saves the abstract affiliation to the database. Creates a new affiliation if id is set, otherwise updates the existing abstract with the given id.
	 */
	function save() {
		// Check the preconditions
		$this->checkId();
		
		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('abstract_affiliation');
		foreach ($this->data as $col => $val) {
			$query->setColumn($col, $val, self::$columnTypes[$col][0]);
		}
		
		// Run it
		$query->execute();
	}
	
	/**
	 * Ensures a valid id. If it is null, creates a new id.
	 */
	private function checkId() {
		if (is_null($this->data['id'])) {
			// Create a new id
			$result = $this->db->query("SELECT MAX(id) FROM abstract_affiliation");
			list($prevId) = $result->fetch_array();
			$this->data['id'] = $prevId + 1;
			$result->free();
		}
	}

	/**
	 * Returns an associative array of the fields.
	 */
	function getFields() {
		return $this->data;
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
		if (array_key_exists($fieldName, self::$columnTypes)) {
			$this->data[$fieldName] = $fieldValue;
		}
		// TODO: warn using syslog if field does not exist
	}
	
	/**
	 * Returns an array of AbstractAffiliationDAO that are associated with the given abstract.
	 */
	static function loadAssociated($db, $abstractId) {
		$abstractIdEscaped = $db->real_escape_string($abstractId);
		$result = $db->query("SELECT * FROM abstract_affiliation WHERE abstract_id=$abstractIdEscaped ORDER BY id");
		
		$associated = array();
		while ($row = $result->fetch_assoc()) {
			$dao = new AbstractAffiliationDAO($db);
			foreach ($row as $key => $val) {
				$dao->setField($key, $val);
			}
			
			$associated[] = $dao;
		}
		
		return $associated;
	}

	/**
	 * Deletes all the affiliations associated with the given abstract ID.
	 */
	static function deleteAssociated($db, $abstractId) {
		$query = $db->prepare("DELETE FROM abstract_affiliation WHERE abstract_id=?");
		$query->bind_param('i', $abstractId);
		$query->execute();
	}
}

?>
