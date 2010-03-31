<?php

/**
 * Data access object for a registrant.
 */
class RegistrantDAO {
	private $db;
	private $data;
	private static $columnTypes = array(
		'id' => array('i', false),
		'auth_key' => array('s', false),
		'firstname' => array('s', true),
		'lastname' => array('s', true),
		'degree' => array('s', true),
		'degree_other' => array('s', false),
		'position' => array('s', true),
		'position_other' => array('s', false),
		'department' => array('s', false),
		'institution' => array('s', true),
		'institution_profile' => array('s', true),
		'institution_profile_other' => array('s', false),
		'street_address' => array('s', true),
		'city' => array('s', true),
		'state_province' => array('s', false),
		'zip_postal_code' => array('s', true),
		'country' => array('s', true),
		'email' => array('s', true),
		'phone' => array('s', true),
		'fax' => array('s', false),
		'submitting_abstract' => array('s', true),
		'abstract_title' => array('s', false),
		'local_attendee' => array('s', true),
		'hotel_parking' => array('s', true),
		'attendance_day1' => array('s', true),
		'attendance_day2' => array('s', true),
		'attendance_day3' => array('s', true),
		'attendance_day4' => array('s', true),
		'meals_day2_breakfast' => array('s', true),
		'meals_day2_lunch' => array('s', true),
		'meals_day2_lunch_entree' => array('s', false),
		'meals_day3_breakfast' => array('s', true),
		'meals_day3_lunch' => array('s', true),
		'meals_day3_lunch_entree' => array('s', false),
		'meals_day4_breakfast' => array('s', true),
		'meals_day4_lunch' => array('s', true),
		'meals_day4_lunch_entree' => array('s', false),
		'meals_gala_dinner' => array('s', true),
		'meals_gala_dinner_vegetarian' => array('s', false),
		'meals_gala_dinner_guests' => array('s', false),
		'meals_gala_dinner_numguests' => array('s', false),
		'share_room' => array('s', false),
		'gender' => array('s', false),
		'arrival_date' => array('s', false),
		'departure_date' => array('s', false),
		'have_promo_code' => array('s', true),
		'promo_code' => array('s', false),
		'total_fee' => array('i', false),
		'payment_type' => array('s', true),
		'comments' => array('s', false),
	);

	/**
	 * Loads the existing registrant with the given ID. If $id is null, creates a new empty registrant.
	 */
	function __construct($db, $id = null) {
		$this->db = $db;

		if ($id !== null) {
			$id_escaped = $this->db->real_escape_string($id);
			$result = $this->db->query("SELECT * FROM registrant WHERE id='$id_escaped'");
			if ($result->num_rows == 0) {
				throw new DAOAuthException("No such registrant");
			}

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
		if (array_key_exists($fieldName, self::$columnTypes)) {
			$this->data[$fieldName] = $fieldValue;
		}
	}

	/**
	 * Saves the registrant to the database. Creates a new registrant if id and auth_key are set, otherwise updates the existing registrant with the given id.
	 *
	 * Throws an exception if id and auth_key are set but invalid (do not exist in the database).
	 */
	function save() {
		// Check the preconditions
		if (!$this->checkIdAuthKey()) {
			throw new DAOAuthException('Invalid ID or auth key');
		}

		// Calculate the total fee
		$this->data['total_fee'] = $this->calculateTotalPrice();

		// Build the query
		$query = new InsertUpdateQuery($this->db);
		$query->setTable('registrant');
		foreach ($this->data as $col => $val) {
			$query->setColumn($col, $val, self::$columnTypes[$col][0]);
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
			$result->free();

			$this->data['auth_key'] = uniqid('', true); // TODO: use a real uuid for more security
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
}
