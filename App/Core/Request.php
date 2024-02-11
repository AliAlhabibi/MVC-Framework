<?php

namespace App\Core;

class Request{
    private $agent;
    private $params;
    private $ip;
    private $method;
    private $uri;

    public function __construct() {
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
        $this->params = $_REQUEST;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->uri = strtok($_SERVER['REQUEST_URI'], '?');
    }
    public function getip()
    {
        return $this->ip;
    } 
    public function getagent()
    {
        return $this->agent;
    }
    public function getparams()
    {
        return $this->params;
    }
    public function getmethod()
    {
        return $this->method;
    }
    public function geturi()
    {
        return $this->uri;
    }
    public function isset($key)
    {
        return isset($this->params[$key]);
    }
    public function redirect()
    {
        //header("location : ". funtion to redirect); redirect using helper function.
        die;
    }
}