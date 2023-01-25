<?php


class TableFieldsDontMatchException extends \Exception{
    use ErrorTrait;

    public function __construct(protected string $message)
    {
        
    }
   
 
}