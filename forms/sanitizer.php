<?php

	function sanitizeString($str) {
		return stripslashes(strip_tags(htmlentities($str)));
	}
	
	function sanitizeSQL($str, $connection) {
		$str = $connection->real_escape_string($str);
		return sanitizeString($str);
	}

?>