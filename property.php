<?php
class Property extends Square {
	private $owner;
	private $mortgaged = FALSE;
	private $houses = 0;
	private $purchasePrice;
	private $rentCosts;
	private $set;
	public $canBuild = TRUE;
	
	public function __construct($key, $data) {
		$this->key = $key;
		list($this->name, $type, $this->purchasePrice, $this->rentCosts) = $data;
	}
	
	public function mortgage(){
		$this->mortgaged = TRUE;
		return $this->mortgageIncome();
	}
	
	public function unmortgage(){
		$this->mortgaged = FALSE;
		return $this->unmortgageCost();
	}
	
	public function mortgageIncome(){
		return $this->purchasePrice / 2;
	}
	
	public function unmortgageCost(){
		return $this->purchasePrice * .55;
	}
	
	public function build($houses){
		if (!$this->canBuild) return FALSE;
		$this->houses += $houses;
	}
	
	public function owner($player){
		$this->owner = $player;
	}
	
	public function rent(){
		return $this->rentCosts[$this->houses];
	}
	
	public function __toString(){
		$out = $this->name;
		if ($this->owner) {
			$out .= ', owned by ' . $this->owner;
			if ($this->houses) {
				$out .= ($this->houses == 5) ? " with {$this->houses} houses" : " with a hotel";
			}
			$out .= ' costing $'.$this->rent().' to rent';
		}
		return $out;
	}
}