<?php

namespace src\core;

use Exception;
use ReflectionClass;
use src\support\RequestType;

class Controller
{
    /**
     * This method is responsible for execute a controller and your method
     *
     * @param string $router
     * @param string $middleware
     * @return void
     */
    public function execute(string $router, string $middleware): void
    {
        if (substr_count($router, '@') <= 0)
            throw new Exception("A rota está registrada com o formato errado");


        list($controller, $method) = explode('@', $router);


        $namespace = 'src\controllers\\';
        $controllerNamespace = "{$namespace}{$controller}";

        if (!class_exists($controllerNamespace))
            throw new Exception("O controller ({$controllerNamespace}) não existe");



        $controller = new $controllerNamespace;
        if (!method_exists($controller, $method)) {
            throw new Exception("O método ({$method}) não existe no controlador ({$controllerNamespace})");
        }

        $params = new ControllerParams;
        $params = $params->get($router, $middleware);



        if (strtoupper(RequestType::get()) === "POST") {
            $reflection = new ReflectionClass($controllerNamespace);

            $parameters = $reflection?->getMethod($method)?->getParameters();
            if ($parameters) {
                if ($parameters)
                    $requestFull = $parameters[0]?->getType()?->getName();

                $request = (new $requestFull());
                $response = $controller->$method($request, ...$params);
            } else {
                $response = $controller->$method(...$params);
            }
        } else {
            $response = $controller->$method(...$params);
        }


        if (!$response::$isString) redirect($response::$redirect);
        else echo $response::$isString;
    }
}
