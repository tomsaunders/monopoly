<?php
class Dice {
	public static $d6 = array(1,6);
	public static function test(){
		$rolls = array_fill(2, 11, 0);
		$count = 100000;
		for($i=0; $i < $count; $i++){
			$roll = self::roll(self::$d6) + self::roll(self::$d6);
			$rolls[$roll]++;
		}
		foreach($rolls as $roll => $occurence){
			$percent = round($occurence / $count * 100,2).'%';
			echo "$roll rolled $occurence times, $percent" . PHP_EOL;
		}
	}
	public static function roll($dice){
		list($min, $max) = $dice;
		return rand($min, $max);
	}
}