<?php

class Invoices{

    public function index ()
    {
       
       return View::make('invoiceView',['layout'=>'layout/mainView','foo'=>'bar']);
      
    }
}

