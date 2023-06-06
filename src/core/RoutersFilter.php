<?php

namespace src\core;

use src\routes\Routes;
use src\support\RequestType;
use src\support\Uri;

class RoutersFilter
{

    private  $uri;
    private  $method;
    private $routesRegistered;

    public function __construct()
    {
        $this->uri = Uri::get();
        $this->method = RequestType::get();
        $this->routesRegistered = Routes::get();
    }

    /**
     * Method for obtaining simple routes
     * 
     * @return string|null
     */
    private function simpleRouter(): string|null
    {
        return array_key_exists($this->uri, $this->routesRegistered[$this->method]) ? $this->routesRegistered[$this->method][$this->uri] : null;
    }


    /**
     * Method obtains dynamic routes
     * 
     * @return string|null
     */
    private function dynamicRouter(): string|null
    {
        $routerRegisteredFound = null;
        foreach ($this->routesRegistered[$this->method] as $index => $route) {
            $regex = str_replace('/', '\/', ltrim($index, '/'));
            if ($index !== '/' and preg_match("/^$regex$/", ltrim($this->uri, '/'))) {
                $routerRegisteredFound = $route;
                break;
            } else
                $routerRegisteredFound = null;
        }
        return $routerRegisteredFound;
    }


    /**
     * Processes the beginning to get simple or dynamic routes
     * 
     * @return string|null
     */
    public function get(): string|null
    {

        $router = $this->simpleRouter();
        if ($router) return $router;


        $router = $this->dynamicRouter();
        if ($router) return $router;

        return null;
    }
}
