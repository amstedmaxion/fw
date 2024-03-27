<?php

namespace src\core;

use src\support\RequestType;
use src\support\Uri;

class ControllerParams
{
    /**
     * This method is responsible for get query params
     *
     * @param string $router_
     * @return array
     */
    public function get(string $router_): array
    {
        $uri = Uri::get();
        $routes = require(PATH_BASE . "/src/routes/Routes.php");

        
        $requestMethod = RequestType::get();


        foreach ($routes[$requestMethod] as $routeKey => $routeValue) {
            $routes[$requestMethod][$routeKey] = mb_substr(
                $routeValue,
                0,
                strpos($routeValue, ":")
            );
        }
        $router_ = array_search($router_, $routes[$requestMethod]);
        
        
        $explodeUri = array_filter(explode('/', $uri));
        $explodeUri = array_values($explodeUri);
        $explodeRouter = array_values(array_filter(explode('/', $router_)));

        $params = [];
        foreach ($explodeRouter as $index => $routerSegment) {
            if (isset($explodeUri[$index]) && $routerSegment !== $explodeUri[$index])
                $params[$index] = $explodeUri[$index];
        }

        return $params;
    }
}
