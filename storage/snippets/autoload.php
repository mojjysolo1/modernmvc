<?php

$class_file_paths=array('classes/','classes/Exceptions/','Controllers/','Models/');
spl_autoload_register(function($className) use($class_file_paths,$env_path) {
  
    foreach($class_file_paths as $paths){

        $paths=$env_path.'/'.$paths;

         if(file_exists($paths.''.$className.'.php'))
        {
            require_once $paths.''.$className.'.php';

         }

       
    
    }


      //add files with namespaces
      $namespace_class=str_replace("\\","/",$className);
      $file=$env_path.'/'.$namespace_class.'.php';
         if(file_exists($file)){

           
            include_once $file;


         }

     
 
      
   

});

?>