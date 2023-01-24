<?php

class ViewNotFoundException extends \Exception{
    use ErrorTrait;
    protected $message="View not found";
 
}

