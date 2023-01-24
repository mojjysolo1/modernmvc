<?php
 require 'c:/wamp64/www/modernMVC/classes/Route.php';

use PHPUnit\Framework\TestCase;
use Classes\Route;
class RouterTest extends TestCase{

    protected function setUp():void
    {
      parent::setUp();
      $this->router=new Route();
    }

    /** @test */
    public function it_registers_a_route():void
    {
        //given the we have a router object
        // $router=new Route;
        //when we call a register method
        $this->router->register('get','/users',['Users','index']);

        $expected=[
            'get'=>[
                '/users'=>['Users','index']
            ]
        ];
        //then we assert route was registered
        $this->assertEquals($expected,$this->router->routes());
    }
    /** @test */
    public function it_registers_a_get_route()
    {
        //given the we have a router object
        // $router=new Route;
        //when we call a register method
        // $this->router->register('get','/users',['Users','index']);
        $this->router->get('/users',['Users','index']);

        $expected=[
            'GET'=>[
                '/users'=>['Users','index']
            ]
        ];
        //then we assert route was registered
        $this->assertEquals($expected,$this->router->routes());
    }

     /** @test */
     public function it_registers_a_post_route()
     {
         //given the we have a router object
        //  $router=new Route;
         //when we call a register method
         // $this->router->register('get','/users',['Users','index']);
         $this->router->post('/users',['Users','index']);
 
         $expected=[
             'POST'=>[
                 '/users'=>['Users','index']
             ]
         ];
         //then we assert route was registered
         $this->assertEquals($expected,$this->router->routes());
     }
     /** @test */
     public function there_are_no_routes_when_router_is_created()
     {
        $this->assertEmpty((new Route)->routes());
        
     }
    

}

?>