<?php

namespace App\Core\Routing;

use App\Core\Request;
use Exception;

class Router{
    private $routes;
    private $request;
    private $current_route;
    const BASE_CONTROLLER = '\App\Controllers\\';

    public function __construct(){
        $this->routes = Route::routes();
        $this->request = new Request();
        $this->current_route = $this->findRoute($this->request) ?? null;
        $this->runMiddleware($this->current_route['middleware']);
    }


    private function runMiddleware($middlewares){
        foreach($middlewares as $middleware){
            $middleware_object = new $middleware;
            $middleware_object->handle();
        }
    }
    public function findRoute(Request $request){
        //echo $request->getmethod(). ' '. $request->geturi();
        foreach($this->routes as $route){
            if(in_array($request->getmethod(), $route['methods']) && $request->geturi() == $route['uri'] )
                return $route;
            return null;

        }
    }

    public function run(){
        # 405 invalid method
    
        #404 not exist
        if(is_null($this->current_route)){
            $this->dispatch404();
        }
        #do the action: dispatch 
        $this->dispatch($this->current_route);


    }
    private function dispatch($route){
        $action = $route['action'];
        #action : null
        if(is_null($action) || empty($action)){
            return null;
        }

        #action : clojure
        if(is_callable($action)){
            // there are two methods to call the clojure method:
            $action();
            //call_user_func($action);
        }

        #action : ['controller', 'method']
        if(is_array($action)){
            $class_name = self::BASE_CONTROLLER . $action[0];
            $method_name = $action[1];

            if(!class_exists($class_name))
                throw new Exception("$class_name not exists");

            if(!method_exists($class_name,$method_name))
                throw new Exception("$method_name not exists in $class_name");
            
            // making an instance from the class. then calling the method
            $controller = new $class_name();
            $controller-> {$method_name}();

        }
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