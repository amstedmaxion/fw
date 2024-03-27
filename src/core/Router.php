<?php

namespace src\core;

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
            
            

            if ($router) {
                if (string_contains($router, ':'))
                    self::executeMiddlewares(
                        array_filter(array_filter(explode(":", $router), function ($r) {
                            return !str_contains($r, '@');
                        }))
                    );
            } else {
                $response = (Response::viewRender('404'));
                echo $response::$isString;
                die;
            }

            
            
            (new Controller)->execute($router);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }



    static function executeMiddlewares(array $middlewares = [])
    {
        foreach ($middlewares as $middlewareKey => $middleware) {
            new $middleware();
        }
    }
}
