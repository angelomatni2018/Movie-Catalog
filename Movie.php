<?php
abstract class Media {
	use GenreOfMedia;
	protected $name, $year_created;
	
	public function Media($n, $year, $g) {
		$this->name = $n;
		$this->year_created = $year;
		$this->genre = $g;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function howOld($year_current) {	
		return $this->year_created - $year_current;
	}

	public abstract function printout();
}

trait GenreOfMedia {
	protected $genre = "";
	
	public function recommend() {
		return "You will like it if you like: ".$this->genre;
	}
}

class Movie extends Media {
	protected $actors, $director;
	
	public function Movie($n, $y, $g = null, $d = null, $a = []) {
		parent::Media($n, $y, $g);
		$this->actors = $a;
		$this->director = $d;
	}
	
	public function printout() {
		return $this->name." is a ".$this->genre." film";
	}
}

class Song extends Media {
	protected $writer;
	
	public function Song($n, $y, $g = null, $writer = "") {
		parent::Media($n,$y,$g);
		$this->writer = $writer;
	}
	
	public function printout() {
		return $this->name." is a ".$this->genre." song";
	}
}

class Symphony extends Song {
	protected $num_movements, $key; 
	
	public function Symphony($n, $y, $g = null, $writer = "", $num_movements = "4", $key = "C") {
		parent::Song($n,$y,$g,$writer);
		$this->num_movements = $num_movements;
		$this->key = $key;
	}
}

class Album  {
	protected $name, $songs;

	public function Album($n, $s) {
		$this->name = $n;
		$this->songs = $s;
	}
}
	
class MediaManager {
	protected $media, $length;
	
	public function MediaManager($media = []) {
		foreach ($media as $value) {
			$this->media[$value->getName()] = $value;
		}
		$this->length = count($this->media);
	}
	
	public function AddMedia($m) {
		$this->media[$m->getName()] = $m;
		$this->length++;
	}
	
	public function RemoveMedia($m) {
		$index = array_search($m->getName(), array_keys($this->media));
		array_splice($this->media, $index, 1);
		$this->length--;
	}
	
	public function GetMedia() {
		return $this->media;
	}
}	

	$mov1 = new Movie("movie1","2000");
	$song1 = new Symphony("song1","1900","classical");
	$mov2 = new Movie("Commando","1985");
	$manager = new MediaManager([$mov1,$mov2,$song1]);
	print_r($manager->GetMedia());
	//echo $song1->printout();
	//echo $song1->recommend();
	//print_r($mov1);
	//print_r($song1); 
	
	
	
	
?>
