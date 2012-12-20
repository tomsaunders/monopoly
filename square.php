<?php
class Square {
	public $key;
	public $name;
	public function __construct($key, $data){
		$this->key = $key;
		$this->name = $data[0];
	}
	
	public function __toString(){
		return $this->name;
	}
	
	public function takeTurn(){
		
	}
	
	public function landedOn(){
		
	}
}