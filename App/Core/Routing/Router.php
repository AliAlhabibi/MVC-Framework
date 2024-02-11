<?php

namespace App\Core\Routing;

use App\Core\Request;

class Router{
    private $routes;
    private $request;
    private $current_route;

    public function __construct(){
        $this->routes = Route::routes();
        $this->request = new Request();
        $this->current_route = $this->findRoute($this->request) ?? null;
    }

    public function findRoute(Request $request){
        //echo $request->getmethod(). ' '. $request->geturi();
        foreach($this->routes as $route){
            if(in_array($request->getmethod(), $route['methods']) && $request->geturi() == $route['uri']){
                print_r($route);
            }
        return null;
        }
    }

    public function run(){
        # 405 invalid method
    
        #404 not exist
        if($this->current_route == null){
            $this->dispatch404();
        }
        #action 
        $this->dispatch($this->current_route);


    }
    private function dispatch(){
        #action : null

        #action : clojure

        #action : controller@method
    }

    public function dispatch404(){
        header("HTTP/1.0 404 Not Found");
        //echo '404 Not Found';
        #include view or use view()
        view('errors.404');
        die();
    }

    public function dispatch405(){
        header("HTTP/1.0 405 Method Not Allowed");
        //echo '405';
        #include view or use view()
        view('errors.405');
        die();
    }
}