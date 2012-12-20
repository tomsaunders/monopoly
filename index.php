<pre>
<?php
require_once('bootstrap.php');
echo get_include_path();
$board = new Board();
$players = array(
	'b' => new Player('Andrew', $board),
	'y' => new Player('Tom', $board),
	'p' => new Player('Dean', $board),
	'r' => new Player('Adam', $board),
);
	
	
setup();

function setup() {
      owner('OKR', 'b');
	  mortgage('OKR');
      owner('WCR', 'b');
	  mortgage('WCR');
      owner('KCS', 'b');
      owner('TAI', 'y');
	  mortgage('TAI');
      owner('Eus', 'y');
	  mortgage('Eus');
      owner('Pen', 'y');
	  mortgage('Pen');
      owner('PaM', 'y', 5);
      owner('ECU', 'b');
	  mortgage('ECU');
      owner('WhH', 'y', 5);
      owner('Nth', 'y', 5);
      owner('Mry', 'b');
      owner('Bow', 'y', 5);
      owner('Mrl', 'y', 5);
      owner('Vin', 'y', 5);
      owner('Str', 'y');
	  mortgage('Str');
      owner('FlS', 'y');
	  mortgage('FlS');
      owner('TSq', 'y');
	  mortgage('TSq');
      owner('Fen', 'b');
      owner('Lei', 'y');
	  mortgage('Lei');
      owner('Cov', 'b');
	  mortgage('Cov');
      owner('WWU', 'b');
	  mortgage('WWU');
      owner('Pic', 'y');
	  mortgage('Pic');
      owner('Reg', 'b', 5);
      owner('OxS', 'b', 5);
      owner('Bnd', 'b', 5);
      owner('Liv', 'b');
      owner('PkL', 'b', 3);
      owner('May', 'b', 3);
	  
	  //flipped colours of player-cards and banks.
      bank('b', 406);
      bank('p', 0);
	  dead('p');
      bank('r', 0);
	  dead('r');
      bank('y', 482);
}

function owner($propKey, $playerKey, $houses=NULL){
	global $players, $board;
	$player = $players[$playerKey];
	$board->owns($player, $propKey, $houses);
}

function mortgage($propKey){
	global $board;
	$board->mortgage($propKey);
}

function bank($playerKey, $total){
	global $players;
	$player = $players[$playerKey];
	$player->setBank($total);
}

function dead($playerKey){
	global $players;
	$player = $players[$playerKey];
	$player->kill();
}

$board->writeStatus();
Dice::test();

?>