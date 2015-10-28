<html>

<head>

  <basefont face="Arial">
  
</head>

<body>

<?php
	require_once 'login.php';
	require 'TableSeeder.php';
	//require $_SERVER['DOCUMENT_ROOT'].'/projects/MovieCollection/TableSeeder.php';
	
	// LOGIN.PHP FILE 
	/*
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "movie_collection"; */

	$table = "users";

	$connection = new mysqli($host, $user, $pass, $db);
	if ($connection->connect_error)
		die ("Unable to connect!");

	$table_seeder = new TableSeeder($connection);
	$table_seeder->seedTable($table, 5);
	
	$query = "SELECT * FROM ".$table;
	
	
	/*
	
	$query = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$table."';";
	
	$result = $connection->query($query);
	if (!$result)
		die($conn->error);
	
	$columns = [];
	$column_types = [];
	for ($i = 0; $i < $result->num_rows; ++$i) {
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$columns[$i] = $row['COLUMN_NAME']; 
		$column_types[$i] = $row['DATA_TYPE'];
	}

	print_r($columns);
	print_r($column_types); */
	
	
	$result = $connection->query($query);
	if (!$result) die($connection->error);

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
		echo "No rows found!";
	} 

	$result->close();
	$connection->close();
?>

</body>

</html>