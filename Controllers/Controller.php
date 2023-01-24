<?php
class Controller{

  public $errmsg_arr = array();
  public  $errflag = false;

    public static function createView($pageView){
      require_once './views/'.$pageView.'.php';
    }

    


}

