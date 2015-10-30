<?php
	include ("standardFormProcedures.php");	
	include ("movieInputer.html");
	
	// Grabbing data from POST global and attempting login
	$username = grabFrom_POST("username");
	$password = grabFrom_POST("password");
	
	// Connect to database
	$connection = new mysqli($host, $user, $pass, "movie_collection2");
	if ($connection->connect_error)
		die ("Unable to connect!");

	sanitizeSQL ($username, $connection);
	sanitizeSQL ($password, $connection);
	
	// grab reviews the user has made before
	$movie_manager = new MovieManager ($connection);	
	$result = $movie_manager->pullAllUserReviews($username);
?>