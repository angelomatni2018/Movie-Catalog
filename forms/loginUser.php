<?php
	require 'sanitizer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/projects/MovieCollection/back_end/MovieManager.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/projects/MovieCollection/login.php';
		
	// Grabbing data from POST global and attempting login
	if (isset($_POST['username']))
		$username = $_POST['username'];
	else
		$username = "empty";
	
	if (isset($_POST['password']))
		$password = $_POST['password'];
	else
		$password = "";
	
	$connection = new mysqli($host, $user, $pass, "movie_collection");
	if ($connection->connect_error)
		die ("Unable to connect!");

	sanitizeSQL ($username, $connection);
	sanitizeSQL ($password, $connection);
	
	$movie_manager = new MovieManager ($connection);
	
	$result = $movie_manager->pullAllUserReviews($username);
	
?>