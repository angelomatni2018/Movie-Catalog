<?php

	class MovieManager {
		public $conn;
	
		public function __construct ($connection) {
			$this->conn = $connection;
		}
		
		public function pullAllUserReviews ($user) {
			$query = "SELECT id FROM users WHERE username='".$user."'";
			//print_r ($query);
			$result = $this->conn->query($query);
			if (!$result) 
				die($this->conn->error);
			
			$id = $result->fetch_array(MYSQLI_NUM)[0];
			
			$query = "SELECT movie_id, review FROM movie_user WHERE user_id='".$id."'";
			//print_r ($query);
			
			$result = $this->conn->query($query);
			if (!$result) 
				die($this->conn->error);

			if ($result->num_rows != 0) {
				echo "<table>";
				for ($i = 0; $i < $result->num_rows; ++$i) {
					$result->data_seek($i);
					$row = $result->fetch_array(MYSQLI_NUM);
					echo "<tr>";
					for ($j = 0; $j < count($row); $j++) {
						echo "<td>".$row[$j]."</td>";
					}
					echo "</tr>";
				}
			}
			else {
				echo "No reviews for this user!";
			} 
		}
	}
	
?>