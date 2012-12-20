<?php
class Player {
	public $name;
	public $active = TRUE;
	public $position = 0;

	private $bank;
	private $board = NULL;
	
	public function __construct($name, $board){
		$this->name = $name;
		$this->board = $board;
	}
	
	public function getBank(){
		return $this->bank;
	}
	
	public function debit($amount){
		$this->bank -= $amount;
	}
	
	public function credit($amount){
		$this->bank += $amount;
	}
	
	public function kill(){
		$this->bank = 0;
		$this->active = FALSE;
	}
	
	public function __toString(){
		return $this->name;
	}
	
	public function move($spaces){
		$this->position += $spaces;	//move the requested number of spaces
		$this->position %= 40;		//but normalise the position number by the number of squares in a full circuit
	}
	
	public function moveTo($position){
		$this->position = $position;
	}
}