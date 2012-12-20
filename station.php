<?php
class Station extends Property {
	public function __construct($key, $data){
		parent::__construct($key, $data);
		$this->canBuild = FALSE;
	}
}