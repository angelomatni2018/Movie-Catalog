<?php

// IMPLEMENT BY INSTANTIATING A SEEDER WITH A SQL CONNECTION,
// CALLING seedTable METHOD WITH table_name, number_rows AS INPUT.
class TableSeeder {
	public $upperCaseChars = ["start" => 65, "end" => 90];
	public $lowerCaseChars = ["start" => 97, "end" => 122];

	public $conn;
	
	public function __construct ($connection) {
		$this->conn = $connection;
	}
	
	public function createRandomString($length) {
		$string = chr(rand($this->upperCaseChars['start'],$this->upperCaseChars['end']));	
		for ($i = 0; $i < $length - 1; ++$i) {
			$string .= chr(rand($this->lowerCaseChars['start'],$this->lowerCaseChars['end']));
		}
		return $string;
	}
	
	public function buildInsertQuery($table) {
		$column_query = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$table."';";
		$result = $this->conn->query($column_query);
		
		if (!$result)
			die($conn->error);
		
		$columns = [];
		$column_types = [];
		for ($i = 0; $i < $result->num_rows; ++$i) {
			$result->data_seek($i);
			$row = $result->fetch_array(MYSQLI_ASSOC);
			
			// Combine these two arrays into a multi-dim one
			$columns[$i] = $row['COLUMN_NAME']; 
			$column_types[$i] = $row['DATA_TYPE'];
		}
		
		$insert_query = "INSERT INTO " .$table." ";
		/*for ($i = 0; $i < count($columns) - 3; ++$i) {
			$insert_query .= $columns[$i].",";
		}
		$insert_query = substr($insert_query, 0, -1); */
		$insert_query .= "VALUES (";
		
		return [$insert_query, $column_types];
	}
	
	public function seedRow($insert_query, $column_types) {
		for ($i = 0; $i < count($column_types); ++$i) {
			if ($column_types[$i] == 'varchar') 
				$insert_query .= "'".$this->createRandomString(rand(5,8))."',";
			else
				$insert_query .= "DEFAULT,";
		}
		$insert_query = substr($insert_query, 0, -1);
		$insert_query .= ")";
		
		$result = $this->conn->query($insert_query);
	}
	
	public function seedTable($table, $num_times) {
		list ($insert_query,$column_types) = $this->buildInsertQuery($table);
		
		for ($i = 0; $i < $num_times; ++$i) {
			$this->seedRow($insert_query, $column_types);
		}
	}
}


?>