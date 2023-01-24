<?php

    $routes=new Route;
    $routes
    ->get('/',[PagesController::class,'index'])
    ->get('/bootstrap',[PagesController::class,'bootstrap'])
    ->get('/person',[PersonController::class,'findPerson'])
    ->get('/email',[EmailController::class,'main'])
    ->get('/invoices',[Invoices::class,'index'])
    ->post('/testclass/store',[TestEnv::class,'store']);
   

(new App($routes))->run(['uri'=>$_SERVER['REQUEST_URI'],'method'=>$_SERVER['REQUEST_METHOD']]);


?>