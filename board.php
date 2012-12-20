<?php
class Board {
	private $squares = array();
	private $players = array();
	private $positions = array();
	private $sets = array();
	
	public function __construct(){
		$sets = array('Brown', 'Aqua', 'Pink', 'Orange', 'Red', 'Yellow', 'Green', 'Blue', 'Station', 'Utility');
		foreach ($sets as $name) {
			$this->sets[$name] = new PropertySet($name);
		}
		
		$squares = array(
			'PAY' => array('GO', 3, 0, array(200, 400)),
			'OKR' => array('Old Kent Road', 0, 60, array(2, 10, 30, 90, 160, 250), 'Brown'), 
			'CC1' => array('Community Chest', 7, 0),
			'WCR' => array('Whitechapel Road', 0, 60, array(4, 20, 60, 180, 320, 450), 'Brown'), 
			'ITx' => array('Income Tax', 9, 200),
			'KCS' => array('Kings Cross Station', 1, 200, array(25, 50, 100, 200)),
			'TAI' => array('The Angel Islington', 0, 100, array(6, 30, 90, 270, 400, 550), 'Aqua'), 
			'Ch1' => array('Chance', 8, 0),
			'Eus' => array('Euston Road', 0, 100, array(6, 30, 90, 270, 400, 550), 'Aqua'), 
			'Pen' => array('Pentonville Road', 0, 120, array(8, 40, 100, 300, 450, 600), 'Aqua'), 
			'Jal' => array('Jail', 4, 0),
			'PaM' => array('Pall Mall', 0, 140, array(10, 50, 150, 450, 625, 750), 'Pink'), 
			'ECU' => array('Electric Company', 2, 150, array(4, 10)),
			'WhH' => array('Whitehall', 0, 140, array(10, 50, 150, 450, 625, 750), 'Pink'),
			'Nth' => array('Northumberland Avenue', 0, 160, array(12, 60, 180, 500, 700, 900), 'Pink'), 
			'Mry' => array('Marylebone Station', 1, 200, array(25, 50, 100, 200)),
			'Bow' => array('Bow Street', 0, 180, array(14, 70, 200, 550, 750, 950), 'Orange'),
			'CC2' => array('Community Chest', 7, 0),
			'Mrl' => array('Marlborough Street', 0, 180, array(14, 70, 200, 550, 750, 950), 'Orange'), 
			'Vin' => array('Vine Street', 0, 200, array(16, 80, 220, 600, 800, 1000), 'Orange'),
			'FPk' => array('Free Parking', 5, 0),
			'Str' => array('The Strand', 0, 220, array(18, 90, 250, 700, 875, 1050), 'Red'),
			'Ch2' => array('Chance', 8, 0),
			'FlS' => array('Fleet Street', 0, 220, array(18, 90, 250, 700, 875, 1050), 'Red'),
			'TSq' => array('Trafalgar Square', 0, 240, array(20, 100, 300, 750, 925, 1100), 'Red'),
			'Fen' => array('Fenchurch St Station', 1, 200, array(25, 50, 100, 200)),
			'Lei' => array('Leicester Square', 0, 260, array(22, 110, 330, 800, 975, 1150), 'Yellow'),
			'Cov' => array('Coventry Street', 0, 260, array(22, 110, 330, 800, 975, 1150), 'Yellow'), 
			'WWU' => array('Water Works', 2, 150, array(4, 10)),
			'Pic' => array('Piccadilly', 0, 280, array(22, 120, 360, 850, 1025, 1200), 'Yellow'),
			'GTJ' => array('Go to Jail', 6, 0),
			'Reg' => array('Regent Street', 0, 300, array(26, 130, 390, 900, 1100, 1275), 'Green'),
			'OxS' => array('Oxford Street', 0, 300, array(26, 130, 390, 900, 1100, 1275), 'Green'),
			'CC3' => array('Community Chest', 7, 0),
			'Bnd' => array('Bond Street', 0, 320, array(28, 150, 450, 1000, 1200, 1400), 'Green'),
			'Liv' => array('Liverpool Street Station', 1, 200, array(25, 50, 100, 200)),
			'Ch3' => array('Chance', 8, 0),
			'PkL' => array('Park Lane', 0, 350, array(35, 175, 500, 1100, 1300, 1500), 'Blue'),
			'STx' => array('Super Tax', 9, 100),
			'May' => array('Mayfair', 0, 400, array(50, 200, 600, 1400, 1700, 2000), 'Blue'),
		);
		foreach($squares as $k => $data){
			$square = $this->initSquare($k, $data);
			$this->positions[] = $square;
			$this->squares[$k] = $square;
		}
	}
	
	private function initSquare($key, $data){
		list(, $type) = $data;
		$square = NULL;
		$set = NULL;
		switch ($type){
			case 0: //property
				$square = new Property($key, $data);
				$set = $this->sets[$data[4]];
				break;
			case 1: //station
				$square = new Station($key, $data);
				$set = $this->sets['Station'];
				break;
			case 2: //util
				$square = new Utility($key, $data);
				$set = $this->sets['Utility'];
				break;
			case 3: //go
				$square = new Go($key, $data);
				break;
			case 4: //jail
				$square = new Jail($key, $data);
				break;
			case 5: //free parking
				$square = new FreeParking($key, $data);
				break;
			case 6: //go to jail
				$square = new GoToJail($key, $data);
				break;
			case 7: //community chest
				$square = new CommunityChest($key, $data);
				break;
			case 8: //chance
				$square = new Chance($key, $data);
				break;
			case 9: //tax
				$square = new Tax($key, $data);
				break;
		}
		if ($set) $set->add($square);
		return $square;
	}
	
	public function owns($player, $propKey, $houses=NULL){
		$property = $this->squares[$propKey];
		$property->owner($player);
		if($houses) $property->build($houses);
	}
	
	public function mortgage($propKey){
		$property = $this->squares[$propKey];
		$property->mortgage();
	}
	
	public function writeStatus(){
		foreach($this->positions as $square){
			echo $square;
			echo PHP_EOL;
		}
	}
	
	public function nextTurn(){
		$player = current($this->players);
		
		//increment player. if false, meaning the last player, reset to the first
		if (!next($this->players)) reset($this->players);
	}
	
	public function gameIsActive(){
		return (count($this->players) > 1);
	}
}