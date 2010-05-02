<?php

function connectToDB() {
	global $Config;
	
	$db = new mysqli($Config['DB']['Host'], $Config['DB']['User'], $Config['DB']['Password'], $Config['DB']['Database']);
	
	if (mysqli_connect_error()) {
		throw new Exception("Error connecting to database: " . mysqli_connect_error);
	}
	
	// Make sure Unicode works
	$db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	
	return $db;
}

// Converts a column name into the piece of SQL that should go in the ON DUPLICATE KEY UPDATE clause
function make_column_update_sql($col) {
	return "$col=VALUES($col)";
}

/**
 * Represents a MySQLi database query that can insert a row or update an existing row.
 */
class InsertUpdateQuery {
	private $db;
	private $table;
	private $columns;
	
	function __construct($db) {
		$this->db = $db;
	}
	
	function setTable($table) {
		$this->table = $table;
	}
	
	function setColumn($name, $val, $type) {
		$col = new QueryColumn();
		$col->name = $name;
		$col->value = $val;
		$col->type = $type;
		
		$this->columns[$name] = $col;
	}
	
	function execute() {
		// Build the query
		$query = $this->db->prepare($this->getQuerySQL());
		if (!$query) {
			throw new Exception("Error preparing query: " . $this->getQuerySQL());
		}
		
		// Gather together the parameter types and values
		$paramTypes = '';
		$colVals = array();
		foreach ($this->columns as $colName => $col) {
			$paramTypes .= ($col->type == 'file') ? 'b' : $col->type;
			$colVals[] = $col->value;
		}

		// Consolidate them into an array of references for bind_param -- see http://stackoverflow.com/questions/2045875/pass-by-reference-problem-with-php-5-3-1
		$paramValRefs = array();
		foreach ($colVals as $key => $val) {
			$paramValRefs[$key] = &$colVals[$key];
		}

		// Bind the parameters
		call_user_func_array(array(&$query, 'bind_param'), array_merge(array($paramTypes), $paramValRefs));

		// Send the long column data
		$colNum = 0;
		foreach ($this->columns as $colName => $col) {
			if ($col->type == 'file') {
				$this->bindFileToQuery($colNum, $col->value, $query);
			}
			
			$colNum++;
		}
		
		// Run the query
		$query->execute();
		if ($this->db->error) {
			throw new Exception("Error executing query: " . $this->db->error);
		}
		
		$query->close();
	}
	
	private function bindFileToQuery($colNum, $filename, $query) {
		$filehandle = @fopen($filename, 'r');
		if ($filehandle) {
			while (!feof($filehandle)) {
				$query->send_long_data($colNum, fread($filehandle, 8192));
			}
			fclose($filehandle);
		}
	}
	
	private function getQuerySQL() {
		return "INSERT INTO $this->table (" . $this->getColNamesSQL() . ") VALUES (" . $this->getColPlaceholdersSQL() . ") ON DUPLICATE KEY UPDATE " . $this->getColUpdateSQL();
	}

	private function getColNamesSQL() {
		return join(', ', array_keys($this->columns));
	}
	
	private function getColPlaceholdersSQL() {
		return join(', ', array_fill(0, count($this->columns), '?'));
	}
	
	private function getColUpdateSQL() {
		return join(', ', array_map('make_column_update_sql', array_keys($this->columns)));
	}
}

/**
 * Represents a column in a SQL query.
 */
class QueryColumn {
	public $name;
	public $value;
	public $type;
}

?>
