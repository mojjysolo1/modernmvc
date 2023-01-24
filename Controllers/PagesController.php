<?php


class PagesController{

    public function index()
    {
      
       return View::make('test',['layout'=>'mainLayoutView',$_GET]);
    }

    public function bootstrap()
    {
        
       return View::make('bootstrapView');
    }

}

?>