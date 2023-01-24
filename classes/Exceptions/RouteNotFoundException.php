<?php


class RouteNotFoundException extends \Exception{
    use ErrorTrait;

    protected $message="Route not found";

   
 
}

