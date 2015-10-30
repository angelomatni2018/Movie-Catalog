<?php
	require 'sanitizer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/projects/MovieCollection/back_end/MovieManager.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/projects/MovieCollection/login.php';
	
	function grabFrom_POST($var_name) {
		if (isset($_POST[$var_name]))
			$var = $_POST[$var_name];
		else
			$var = null;
		return $var;
	} 
?>