<?php
session_start();
require 'vendor/autoload.php';
use \React\EventLoop\Factory;
use \React\EventLoop\TimerInterface;

$loop = Factory::create();

$counter=0;
$loop->addPeriodicTimer(1, function(TimerInterface $timer){
	global $counter,$loop;
	echo "Hello ".$counter."\n";
	$counter++;

	if($counter==5)
	      $loop->cancelTimer($timer);

});



$loop->run();
?>