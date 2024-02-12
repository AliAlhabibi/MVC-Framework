<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;
use Exception;
use hisorange\BrowserDetect\Parser as Browser;


class BlockFirefox implements Middlewareinterface{

    public function handle(){
        if(Browser::isFirefox())
            throw new Exception('Block Firefox');
        
    }
}