<?php

namespace src\core;

use Exception;

class Router
{
    /**
     * Method responsible for starting the application execution process
     * 
     * @return void
     */
    public static function run(): void
    {
        try {
            $routerRegistered = new RoutersFilter;
            $router = $routerRegistered->get();
            $middleware = '';
            if ($router) {
                if (string_contains($router, ':')) {
                    [$router, $middleware] = explode(':', $router);
                }
            } else 
                throw new Exception("A rota informada não existe");
            

            $controller = new Controller;
            $controller->execute($router, $middleware);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
