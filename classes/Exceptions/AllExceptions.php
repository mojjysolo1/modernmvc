<?php

class AllExceptions extends \Exception{
    use ErrorTrait;
    
    protected $message;
    protected string $file;
    protected int $line;

        public function __construct(\Throwable $e)
        {
            $this->message=$e->getMessage();
            $this->file=$e->getFile();
            $this->line=$e->getLine();
        }




}


