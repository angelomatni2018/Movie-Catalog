<?php

	function sanitizeString($str) {
		return stripslashes(strip_tags(htmlentities($str)));
	}
	
	function sanitizeSQL($str_array, $connection) {
		for($i = 0; $i < count($str_array); ++$i) {
			$str_array[$i] = $connection->real_escape_string($str_array[$i]);
			$str_array[$i] = sanitizeString($str_array[$i]);
		}
	}

?>