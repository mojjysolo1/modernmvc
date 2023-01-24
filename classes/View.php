<?php

class View{
   
    public function __construct(protected string $view,protected array $params=[])
    {

    }

     public static function make(string $view,array $params=[]):static
     {
         return new static($view,$params);
     }

  
    public function render():string
    {

        $viewPath=!empty($this->view)?$_SESSION['DOCUMENT_ROOT'].'/Views/'.$this->view.'.php':'';
        $layoutPath=array_key_exists('layout',$this->params)?$_SESSION['DOCUMENT_ROOT'].'/Views/layout/'.$this->params['layout'].'.php':'';
          
        //unset for hackers and extract params array into variables
        unset($this->params['viewPath']);
          extract($this->params);

            if($this->params['layout']==''){

                if(!file_exists($viewPath))
            throw new ViewNotFoundException();
                    
                ob_start();
                include $viewPath;
        
                return (string)ob_get_clean();

            }else{

                if(!file_exists($layoutPath))
                  throw new ViewNotFoundException();


                    ob_start();

                    include $viewPath;
            
                   $buff_view=(string)ob_get_clean();
                

               ob_start();
                include $layoutPath;
        
               $buff_layout_view=(string)ob_get_clean();

               $combinedview=str_replace("{{content}}",$buff_view,$buff_layout_view);

               return  $combinedview;

            }
       
    }

    public function __toString():string
    {
       return $this->render();
    }

}

