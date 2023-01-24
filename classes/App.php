<?php
class App{

    public function __construct(public Route $routeObj)
    {
        
    }

    public function run(array $requestUri)
    {
       
       try{

        echo $this->routeObj->resolve(
            $requestUri['uri'],
            $requestUri['method']);

        }catch(RouteNotFoundException $e){
           
            http_response_code(404);
          echo $e->getError();
    
         }


    }
}

