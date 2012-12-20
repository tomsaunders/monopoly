<?php

//require('../player.php');
class PlayerTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var Player
	 */
	protected $player;

	/** @var Board (mock) */
	protected $board;
	protected $playerName;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->board = $this->getMock('Board');
		$this->playerName = 'Test';
		$this->player = new Player($this->playerName, $this->board);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	public function testBanking(){
		$this->player->credit(2000);
		$this->assertEquals(2000, $this->player->getBank());
		$this->player->debit(200);
		$this->assertEquals(1800, $this->player->getBank());
	}

	/**
	 * @covers Player::kill
	 * @todo   Implement testKill().
	 */
	public function testKill() {
		$this->player->kill();
		$this->assertFalse($this->player->active);
		$this->assertEquals(0, $this->player->getBank());
	}

	/**
	 * @covers Player::__toString
	 * @todo   Implement test__toString().
	 */
	public function test__toString() {
		$this->assertEquals($this->playerName, $this->player);
	}

	/**
	 * @covers Player::move
	 */
	public function testMove() {
		$this->assertEquals(0, $this->player->position, "Player starts at Go");
		$this->player->move(10);
		$this->assertEquals(10, $this->player->position, "Just visiting");
		$this->player->move(10);
		$this->assertEquals(20, $this->player->position, "Free parking");
		$this->player->move(11);
		$this->assertEquals(31, $this->player->position, "Green. Just after Go To Jail");
		$this->player->move(10);
		$this->assertEquals(1, $this->player->position, "Old Kent Road");
	}

	/**
	 * @covers Player::moveTo
	 */
	public function testMoveTo() {
		$this->assertEquals(0, $this->player->position, "Player starts at Go");
		$this->player->move(10);
		$this->assertEquals(10, $this->player->position, "Just visiting");
		$this->player->move(10);
		$this->assertEquals(20, $this->player->position, "Free parking");
		$this->player->move(10);
		$this->assertEquals(10, $this->player->position, "Gone to Jail");
	}

}
