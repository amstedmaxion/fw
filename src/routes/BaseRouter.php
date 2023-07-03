<?php

namespace src\routes;

use Closure;
use src\support\Uri;

class BaseRouter
{
    /**
     * Array that stores routes
     */
    public $routes = [
        "get" => [],
        "post" => [],
        "put" => [],
        "delete" => []
    ];

    /**
     * Responsible for joining middlewares with limiter
     * @param array $middlewares
     * @return ?string
     */
    function joinMiddlewares(array $middlewares = []): ?string
    {
        return implode(":", $middlewares);
    }

    /**
     * Responsible for adding the route to the array $routes
     * @param string $method
     * @param string $uri
     * @param string $controller
     * @param string $controllerMethod
     * @param array $middlewares
     */
    function add(string $method, string $uri, string $controller, string $controllerMethod, array $middlewares = [])
    {
        $middlewares = $this->joinMiddlewares($middlewares);
        $this->routes[strtolower($method)]["{$uri}"] =
            "{$controller}@{$controllerMethod}:{$middlewares}";
        return $this;
    }

    /**
     * Responsible for adding a Get type route
     * @param string $endpoint
     * @param string $controller
     * @param string $method
     * @param string $prefix
     * @param array $middlewares
     */
    function get(string $endpoint, string $controller, string $method, string $prefix = '', array $middlewares = [])
    {
        return $this->add("GET", $prefix . $endpoint, $controller, $method, $middlewares);
    }

    /**
     * Responsible for adding a Get type route
     * @param string $endpoint
     * @param string $controller
     * @param string $method
     * @param string $prefix
     * @param array $middlewares
     */
    function post(string $endpoint, string $controller, string $method, string $prefix = '', array $middlewares = [])
    {
        return $this->add("POST", $prefix . $endpoint, $controller, $method, $middlewares);
    }


    /**
     * Responsible for adding a Get type route
     * @param string $endpoint
     * @param string $controller
     * @param string $method
     * @param string $prefix
     * @param array $middlewares
     */
    function delete(string $endpoint, string $controller, string $method, string $prefix = '', array $middlewares = [])
    {
        return $this->add("DELETE", $prefix . $endpoint, $controller, $method, $middlewares);
    }

    /**
     * Responsible for adding a Get type route
     * @param string $endpoint
     * @param string $controller
     * @param string $method
     * @param string $prefix
     * @param array $middlewares
     */
    function put(string $endpoint, string $controller, string $method, string $prefix = '', array $middlewares = [])
    {
        return $this->add("PUT", $prefix . $endpoint, $controller, $method, $middlewares);
    }
   
    /**
     * Responsible for receiving and executing the meddlewares of the grouping
     * 
     * @param array $middlewares 
     * @param string $prefix
     */
    function middlewares(array $middlewares = [], string $prefix = "")
    {
        if (string_contains(Uri::get(), $prefix)) {
            foreach ($middlewares as $middlewareKey => $middleware) {
                (new $middleware());
            }
        }
        return $this;
    }


    /**
     * Responsible for performing the grouping of routes
     * @param string $prefix
     * @param Closure $callback
     * @param array $middlewares
     * 
     * @return self
     */
    function group(string $prefix, Closure $callback, array $middlewares = [])
    {
        if (!empty($middlewares))
            $this->middlewares($middlewares, $prefix);
        $callback->call($this, $prefix);
        return $this;
    }

    /**
     * Responsible for returning the routes
     * @return array
     */
    function init(): array
    {
        return $this->routes;
    }
}
