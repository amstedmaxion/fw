<?php

namespace src\core;

use src\routes\Routes;
use src\support\RequestType;
use src\support\Uri;

class ControllerParams
{
    /**
     * This method is responsible for get query params
     *
     * @param string $router
     * @param string $middleware
     * @return array
     */
    public function get(string $router, string $middleware): array
    {
        $uri = Uri::get();
        $routes = Routes::get();
        $requestMethod = RequestType::get();

        if ($middleware) $router = "{$router}:{$middleware}";
        $router = array_search($router, $routes[$requestMethod]);


        $explodeUri = array_filter(explode('/', $uri));
        $explodeUri = array_values($explodeUri);
        $explodeRouter = array_values(array_filter(explode('/', $router)));


        $params = [];
        foreach ($explodeRouter as $index => $routerSegment) {
            if (isset($explodeUri[$index]) && $routerSegment !== $explodeUri[$index]) 
                $params[$index] = $explodeUri[$index];
            
        }

        return $params;
    }
}
