<?php
session_start();
require 'vendor/autoload.php';
$_SESSION['d']=0;
$loop = React\EventLoop\Factory::create();

$loop->addTimer(1, function(){
	echo 'after timer\n';

});


echo 'before timer\n';

$loop->run();
?>