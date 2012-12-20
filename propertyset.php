<?php
class PropertySet {
	private $properties = array();
	
	public function isComplete(){
		$owner = NULL;
		foreach($this->properties as $property){
			if (!$property->owned) return FALSE;
			
			if (!$owner) $owner = $property->owner;
			else if ($owner != $property->owner) return FALSE;
		}
		return TRUE;
	}
	
	public function add($property){
		$this->properties[] = $property;
	}
	
	public function countOwnedBy($owner){
		$count = 0;
		foreach ($this->properties as $property) {
			if ($property->owner == $owner) $count++;
		}			
		return $count;
	}
}