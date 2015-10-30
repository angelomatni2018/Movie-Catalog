<?php
	include ("standardFormProcedures.php");	
	include ("movieInputer.html");
	
	// Grabbing data from POST global and attempting login
	$movie_data = ["title" => grabFrom_POST("title"), "genre" => grabFrom_POST("genre")
					"director" => grabFrom_POST("director"), "date" => grabFrom_POST("date"),
					"summary" => grabFrom_POST("summary")];
	
	foreach ($movie_data as $data) {
		if ($data == null)
			echo "Not all fields were filled in.";
	}
	
	// Connect to database
	$connection = new mysqli($host, $user, $pass, "movie_collection2");
	if ($connection->connect_error)
		die ("Unable to connect!");

	sanitizeSQL ($movie_data);
	
	$movie_manager = new MovieManager ($connection);
	
	// INSERT CODE HERE TO ADD FILM TO DATABASE
?>