<?php
//require('../dice.php');
class DiceTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var Dice
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Dice;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 * @covers Dice::test
	 * @todo   Implement testTest().
	 */
	public function testRandomness() {
		$rolls = array_fill(2, 11, 0);
		$count = 100000;
		for($i=0; $i < $count; $i++){
			$roll = Dice::roll(Dice::$d6) + Dice::roll(Dice::$d6);
			$rolls[$roll]++;
		}
		$expected = array();
		$expected[2] = $expected[12] = 1/36;
		$expected[3] = $expected[11] = 2/36;
		$expected[4] = $expected[10] = 3/36;
		$expected[5] = $expected[9]  = 4/36;
		$expected[6] = $expected[8]  = 5/36;
		$expected[7] =				   6/36;
		
		foreach ($rolls as $total => $occurence){
			$percentage = $occurence/$count;
			$this->assertEquals($expected[$total], $percentage, "Occurence of $total is within expected probability.", 0.02);
		}
	}

}
