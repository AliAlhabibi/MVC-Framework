<?php

namespace App\Core\Routing;

class Route{
    private static $routes = array();

    private static function add($methods , $uri , $action = null)
    {
        $methods = is_array($methods) ? $methods : [$methods];
        self::$routes[] = array("methods" => $methods,"uri" => $uri,"action" => $action);
    }
    public static function get($uri , $action)
    {
        self::add("get" , $uri , $action);
    }
    public static function post($uri , $action)
    {
        self::add("post" , $uri , $action);
    }
    public static function put($uri , $action)
    {
        self::add("put" , $uri , $action);
    }
    public static function patch($uri , $action)
    {
        self::add("patch" , $uri , $action);
    }
    public static function delete($uri , $action)
    {
        self::add("delete" , $uri , $action);
    }
    public static function options($uri , $action)
    {
        self::add("options" , $uri , $action);
    }
    public static function routes()
    {
        return self::$routes;
    }
}