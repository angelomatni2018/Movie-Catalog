<?php

	function sanitizeString($str) {
		return stripslashes(strip_tags(htmlentities($str)));
	}
	
	function sanitizeMySQL($connection, $str) {
		$str = $connection->real_escape_string($str);
		return sanitizeString($str);
	}

?>