<?php

/**
 * Data access object for a registrant.
 */
class RegistrantDAO {
	private $db;
	private $data;
	public static $columnTypes = array(
		'id' => array(
			'type' => 'i',
			'form' => null,
			'required' => false
		),
		'auth_key' => array(
			'type' => 's',
			'form' => null,
			'required' => false
		),
		'firstname' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'middlename' => array(
			'type' => 's',
			'form' => 1,
			'required' => false
		),
		'lastname' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'degree' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'degree_other' => array(
			'type' => 's',
			'form' => 1,
			'required' => false
		),
		'position' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'position_other' => array(
			'type' => 's',
			'form' => 1,
			'required' => false
		),
		'department' => array(
			'type' => 's',
			'form' => 1,
			'required' => false
		),
		'institution' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'institution_profile' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'institution_profile_other' => array(
			'type' => 's',
			'form' => 1,
			'required' => false
		),
		'street_address' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'street_address_2' => array(
			'type' => 's',
			'form' => 1,
			'required' => false
		),
		'city' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'state_province' => array(
			'type' => 's',
			'form' => 1,
			'required' => false
		),
		'zip_postal_code' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'country' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'email' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'phone' => array(
			'type' => 's',
			'form' => 1,
			'required' => true
		),
		'fax' => array(
			'type' => 's',
			'form' => 1,
			'required' => false
		),

		'submitting_abstract' => array(
			'type' => 's',
			'form' => 2,
			'required' => true
		),

		'local_attendee' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'hotel_parking' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'attendance_day1' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'attendance_day2' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'attendance_day3' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'attendance_day4' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'meals_day2_breakfast' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_day2_lunch' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_day2_lunch_entree' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_day3_breakfast' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_day3_lunch' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_day3_lunch_entree' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_day4_breakfast' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_day4_lunch' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_day4_lunch_entree' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_gala_dinner' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'meals_gala_dinner_vegetarian' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_gala_dinner_guests' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'meals_gala_dinner_numguests' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'share_room' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'gender' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'arrival_date' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'departure_date' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'have_promo_code' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'promo_code' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
		'total_fee' => array(
			'type' => 'i',
			'form' => null,
			'required' => false
		),
		'payment_type' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
		'comments' => array(
			'type' => 's',
			'form' => 3,
			'required' => false
		),
	);
	private $dirty = array();
	private $abstract;
	private $galaGuests = array();

	/**
	 * Loads the existing registrant with the given ID. If $id is null, creates a new empty registrant. If $abstract is null, loads the associated abstract.
	 */
	function __construct($db, $id = null, $abstract = null) {
		$this->db = $db;

		// If given an ID, load the pre-existing registrant from the DB
		if ($id !== null) {
			$id_escaped = $this->db->real_escape_string($id);
			$result = $this->db->query("SELECT * FROM registrant WHERE id='$id_escaped'");
			if ($result->num_rows == 0) {
				throw new DAOAuthException("No such registrant");
			}

			$row = $result->fetch_assoc();
			$result->free();

			// Do not store auth_key for security
			// This prevents the following scenario:
			// $abstract = new AbstractDAO(100); // Loads abstract from DB, including auth_key
			// $abstract->setField('abstract_title', 'bogus');
			// $abstract->save(); // Checks auth_key, which will always be correct, since it was just loaded from the DB. Data has been modified without proper authentication!
			unset($row['auth_key']);

			// Copy the row data into the abstract fields
			// Use foreach and setField instead of a straight array copy because setField checks whether each column is a valid abstract entry. This drops any columns that are in the database but not valid for the DAO.
			foreach ($row as $key => $val) {
				$this->setField($key, $val, true);
			}

			// Load the associated information
			$this->galaGuests = RegistrantGalaGuestDAO::loadAssociated($this->db, $this->data['id']);

			// Load the associated registrant if necessary
			if ($abstract === null) {
				$this->abstract = AbstractDAO::loadAssociated($this->db, $this->data['id'], $this);
			} else {
				$this->abstract = $abstract;
			}
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

	/**
	 * Returns the gala guest at the given index. If it doesn't exist, creates a new one automatically.
	 */
	function getGalaGuest($index) {
		if (!isset($this->galaGuests[$index])) {
			$this->galaGuests[$index] = new RegistrantGalaGuestDAO($this->db);
		}
		return $this->galaGuests[$index];
	}

	/**
	 * Returns all gala guests.
	 */
	function getGalaGuests() {
		return $this->galaGuests;
	}

	function clearGalaGuests() {
		$this->galaGuests = array();
	}

	/**
	 * Returns the associated abstract, or null if it doesn't exist.
	 */
	function getAbstract() {
		return $this->abstract;
	}

	/**
	 * Returns the associated abstract, initializing it if necessary.
	 */
	function getAbstractInit() {
		if (!isset($this->abstract)) {
			$this->abstract = new AbstractDAO($this->db);
		}
		return $this->abstract;
	}

	/**
	 * Saves the registrant to the database. Creates a new registrant if id and auth_key are set, otherwise updates the existing registrant with the given id.
	 *
	 * Throws an exception if id and auth_key are set but invalid (do not exist in the database).
	 * 
	 * @param boolean $finalize whether or not to mark the abstract as "final," meaning it cannot be edited anymore. Set to false when only previewing the abstract.
	 */
	function save($finalize = true) {
		// Check the preconditions
		if (!$this->checkIdAuthKey()) {
			throw new DAOAuthException('Invalid ID or auth key');
		}

		// Calculate the total fee
		$this->data['total_fee'] = $this->calculateTotalPrice();
		$this->dirty['total_fee'] = true;

		// Clear and reinsert the lists
		RegistrantGalaGuestDAO::deleteAssociated($this->db, $this->data['id']);
		foreach ($this->galaGuests as $galaGuest) {
			$galaGuest->setField('registrant_id', $this->data['id']);
			$galaGuest->save();
		}

		// Save the abstract
		if (isset($this->abstract)) {
			$this->abstract->setField('registrant_id', $this->data['id']);
			$this->abstract->save();
		}

		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('registrant');
		foreach ($this->data as $col => $val) {
			// Only update the column if it's been modified, or it's the ID column (which is necessary for updating)
			if ($this->dirty[$col] || $col == 'id') {
				$query->setColumn($col, $val, self::$columnTypes[$col]['type']);
				$this->dirty[$col] = false;
			}
		}

		// Run it
		$query->execute();
	}

	/**
	 * Deletes the registrant from the database. Throws an exception if id is invalid.
	 */
	function delete() {
		$query = $this->db->prepare("DELETE FROM registrant WHERE id=?");
		$query->bind_param('i', $this->data['id']);
		$query->execute();
		$query->store_result();

		if ($query->affected_rows != 1) {
			throw new DAOAuthException("Invalid ID");
		}

		// Delete the associated data
		RegistrantGalaGuestDAO::deleteAssociated($this->db, $this->data['id']);
	}

	/**
	 * Checks whether or not the given fields are valid. Returns an array of invalid fields. This array will be empty if all fields are valid. If $formNumber is set, only checks the fields from that form
	 */
	function validate($formNumber = null) {
		$invalidFields = array();

		// Check if all required fields are present
		foreach (self::$columnTypes as $colName => $colInfo) {
			// If the column is required for this form number, make sure it's non-empty in $this->data
			if ($colInfo['required']
			    && isset($formNumber)
			    && isset($colInfo[$formNumber])
			    && $formNumber == $colInfo['formNumber']
			) {
				if (empty($this->data[$colName])) {
					$invalidFields[] = $colName;
				}
			}
		}

		// TODO: also check the associated objects

		return $invalidFields;
	}

	/**
	 * Returns an associative array of the fields.
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
			$query = $this->db->prepare("SELECT id FROM registrant WHERE id=? AND auth_key=?");
			$query->bind_param('is', $this->data['id'], $this->data['auth_key']);
			$query->execute();
			$query->store_result();

			return $query->num_rows() > 0;
		} else {
			// Create a new id and auth key
			$result = $this->db->query("SELECT MAX(id) FROM registrant");
			list($prevId) = $result->fetch_array();
			$this->data['id'] = $prevId + 1;
			$this->dirty['id'] = true;
			$result->free();

			$this->data['auth_key'] = uniqid('', true); // TODO: use a real uuid for more security
			$this->dirty['auth_key'] = true;
			return true;
		}
	}

	/**
	 * Uses the information in $this->data to calculate the total price and returns it.
	 */
	private function calculateTotalPrice() {
		// Determine the fee classes based on the date
		if ($now <= strtotime('June 4, 2010')) {
			$postdoc_fee = 150;
			$other_fee = 250;
		} else {
			$postdoc_fee = 250;
			$other_fee = 350;
		}

		// Determine which fee class to use based on the position (unless the promo code is valid)
		$base_fee = 0;
		if (!RegistrantDAO::checkPromoCode($this->data['promo_code'])) {
			switch ($this->data['position']) {
				case "postdoc":
				case "grad_student":
				case "undergrad_student":
					$base_fee = $postdoc_fee;
					break;
				default:
					$base_fee = $other_fee;
			}
		}

		// Calculate the gala dinner guest fee
		$gala_dinner_guest_fee = 0;
		if (!empty($this->data['meals_gala_dinner_numguests'])) {
			$gala_dinner_guest_fee = 70 * intval($this->data['meals_gala_dinner_numguests']);
			// TODO: check for negative numbers
		}

		// Total it up and return
		return $base_fee + $gala_dinner_guest_fee;
	}

	/**
	 * Checks if the given promotional code is valid. Not case sensitive.
	 */
	public static function checkPromoCode($code) {
		return strtoupper($code) == 'JF2010AS';
	}

	public static function getAll($db) {
		$result = $db->query("SELECT id FROM registrant ORDER BY id");

		$all = array();
		while ($row = $result->fetch_assoc()) {
			$dao = new RegistrantDAO($db, $row['id']);
			$all[] = $dao;
		}
		$result->free();

		return $all;
	}
}

class RegistrantGalaGuestDAO {
	private $db;
	private $data;
	private static $columnTypes = array(
		'id' => array(
			'type' => 'i',
			'form' => null,
			'required' => false
		),
		'registrant_id' => array(
			'type' => 'i',
			'form' => null,
			'required' => false
		),
		'vegetarian' => array(
			'type' => 's',
			'form' => 3,
			'required' => true
		),
	);

	function __construct($db) {
		$this->db = $db;
	}

	/**
	 * Saves the gala guest to the database. Creates a new gala guest if id is set, otherwise updates the existing gala guest with the given id.
	 */
	function save() {
		// Check the preconditions
		$this->checkId();

		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('registrant_gala_guest');
		foreach ($this->data as $col => $val) {
			$query->setColumn($col, $val, self::$columnTypes[$col]['type']);
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
			$result = $this->db->query("SELECT MAX(id) FROM registrant_gala_guest");
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
	 * Returns an array of RegistrantGalaGuestDAO that are associated with the given registrant.
	 */
	static function loadAssociated($db, $registrantId) {
		$registrantIdEscaped = $db->real_escape_string($registrantId);
		$result = $db->query("SELECT * FROM registrant_gala_guest WHERE registrant_id=$registrantIdEscaped ORDER BY id");

		$associated = array();
		while ($row = $result->fetch_assoc()) {
			$dao = new RegistrantGalaGuestDAO($db);
			foreach ($row as $key => $val) {
				$dao->setField($key, $val);
			}

			$associated[] = $dao;
		}
		$result->free();

		return $associated;
	}

	/**
	 * Deletes all the gala guests associated with the given registrant ID.
	 */
	static function deleteAssociated($db, $registrantId) {
		$query = $db->prepare("DELETE FROM registrant_gala_guest WHERE registrant_id=?");
		$query->bind_param('i', $registrantId);
		$query->execute();
	}
}