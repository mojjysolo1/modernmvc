<?php
session_start();

  $env_path=substr(__DIR__,0,-7);

 
require_once '../vendor/autoload.php';


use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($env_path);
$dotenv->load();

// //global error handler
set_exception_handler(function(\Throwable $e){
  $exception=new AllExceptions($e);
  echo $exception->getError();
});


require_once 'config.php';

require_once $env_path.'/classes/Functions.php';

require_once 'routes.php';


?>