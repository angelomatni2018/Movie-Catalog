<?php

// CLASS USED TO MANAGE SCRIPTS PARSED THROUGH
class ScriptManager {
	protected $scripts = ["scriptName" => "scriptFile"];
	
	// Pulled from a database (A list of 100 most used words, something like what Wikipedia has)
	protected $most_common_words; 
	
	protected $scriptParser = new ScriptParser($most_common_words)
	
	// Other stuff will go here too;
}

// CLASS USED TO PARSE THROUGH SCRIPTS AND ORGANIZE LINES
class ScriptParser {
	protected $common_words;
	
	public function ScriptParser($common_words_list) {
		$this->common_words = $common_words_list;	
	}
	
	public function parseLineForTags($line) {
		$line_tags;
		$words = explode(' ', $line);
		
		foreach ($words as $num => $word) {
			$tag;
			// Check to see if $word is valid (not just spaces, etc...)
			// Tag this line with the list of common words $common_words
			
			// Log tag for the word 
			$line_tags[] = $tag;
		}
		return $line_tags
	}
	
	public function parseScript($script) {
		$script_tags;
		$rows = explode ("\n", $script);
		
		foreach ($rows as $row => $line) {
			// Use parseLineForTags to get tags for the line
			// Organize tags in a smart way
			// Try and also organize lines by character if possible
		}
	}
}

?>