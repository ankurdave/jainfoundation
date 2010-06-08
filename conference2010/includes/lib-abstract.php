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
		'abstract_comments' => array('s', false),
	);
	private $dirty = array();
	private $authors = array();
	private $affiliations = array();
	private $registrant;
	
	/**
	 * Loads the existing abstract with the given ID. If $id is null, creates a new empty abstract. If $registrant is null, loads the associated registrant.
	 */
	function __construct($db, $id = null, $registrant = null, $loadPicture = false) {
		$this->db = $db;

		// If given an ID, load the pre-existing abstract from the DB
		if ($id !== null) {
			$id_escaped = $this->db->real_escape_string($id);
			$result = $this->db->query("SELECT id, registrant_id, picture_mimetype, " . ($loadPicture ? 'picture_data, ' : '') . "abstract_category, abstract_category_other, presentation_type, abstract_title, abstract_body, final, abstract_comments FROM abstract WHERE id='$id_escaped'"); // all but picture_data
			if ($result->num_rows == 0) {
				throw new DAOAuthException("No such abstract");
			}
			
			$row = $result->fetch_assoc();
			$result->free();
			
			// Copy the row data into the abstract fields
			// Use foreach and setField instead of a straight array copy because setField checks whether each column is a valid abstract entry. This drops any columns that are in the database but not valid for the DAO.
			foreach ($row as $key => $val) {
				$this->setField($key, $val, true);
			}
			
			// Load the associated authors and affiliations
			$this->authors = AbstractAuthorDAO::loadAssociated($this->db, $this->data['id']);
			$this->affiliations = AbstractAffiliationDAO::loadAssociated($this->db, $this->data['id']);
		}

		// Load the associated registrant
		if ($registrant === null) {
			$this->registrant = new RegistrantDAO($this->db, $this->data['registrant_id']);
		} else {
			$this->registrant = $registrant;
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
	 * 
	 * @param boolean $skipDirty whether to skip setting the dirty flag for this field. Useful when loading all the field values for the first time.
	 */
	function setField($fieldName, $fieldValue, $skipDirty = false) {
		if (array_key_exists($fieldName, self::$columnTypes)) {
			$this->data[$fieldName] = $fieldValue;
			
			if (!$skipDirty) {
				// Set the dirty flag so save() knows to save this change to the DB
				$this->dirty[$fieldName] = true;
			}
		}
		// TODO: warn using syslog if field does not exist
	}

	function getRegistrant() {
		return $this->registrant;
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
	 * @param boolean $finalize whether or not to mark the abstract as "final," meaning it cannot be edited anymore.
	 * @param boolean $force if true, forces the save even if auth_key is false or final is true. Defaults to false.
	 */
	function save($finalize = false, $force = false) {
		// Check the preconditions
		if (!$this->checkId()) {
			throw new DAOAuthException('Invalid ID');
		}
		if (!$force && $this->checkFinal()) {
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
		// If it's already true, don't change that
		$this->data['final'] = $finalize || $this->data['final'];
		$this->dirty['final'] = true;
		
		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('abstract');
		foreach ($this->data as $col => $val) {
			// Only update the column if it's been modified, or it's the ID column (which is necessary for updating)
			if ($this->dirty[$col] || $col == 'id') {
				$query->setColumn($col, $val, self::$columnTypes[$col][0]);
				$this->dirty[$col] = false;
			}
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
			$this->dirty['id'] = true;
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
	 * 
	 * @param RegistrantDAO $registrant a reference to the RegistrantDAO to associate with the abstract. If null, the abstract will load a new copy of the appropriate RegistrantDAO from the database.
	 */
	static function loadAssociated($db, $registrantId, $registrant = null) {
		$registrantIdEscaped = $db->real_escape_string($registrantId);
		$result = $db->query("SELECT id FROM abstract WHERE registrant_id=$registrantIdEscaped");
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$result->free();
			$dao = new AbstractDAO($db, $row['id'], $registrant);
			return $dao;
		} else {
			$result->free();
			return null;
		}
	}

	/**
	 * Returns an array of all the abstracts in the DB.
	 */
	static function loadAll($db, $constraints = array()) {
		// Get a list of all the IDs and load it with each abstract
		// TODO: this does O(n) queries (O(1) per abstract), so it won't scale well
		// Prepare the query and bind the params
		$whereClauseSql = makeSqlWhere($constraints, self::$columnTypes, $db);
		$result = $db->query("SELECT id FROM abstract $whereClauseSql ORDER BY id");
		$abstracts = array();
		while ($row = $result->fetch_assoc()) {
			try {
				$abstracts[] = new AbstractDAO($db, $row['id']);
			} catch (DAOAuthException $e) {
				error_log("Error loading abstract #" . $row['id']);
			}
		}
		$result->free();

		return $abstracts;
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
		$result->free();
		
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
		$result->free();
		
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
