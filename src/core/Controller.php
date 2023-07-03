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
     * @return void
     */
    public function execute(string $router): void
    {
        $explode = explode(":", $router);
        $router = $explode[0];

        if (substr_count($router, '@') <= 0)
            throw new Exception("A rota está registrada com o formato errado");

        list($controller, $method) = explode('@', $router);

        if (!class_exists($controller))
            throw new Exception("O controller ({$controller}) não existe");


        $controller = (new $controller);
        if (!method_exists($controller, $method)) {
            throw new Exception("O método ({$method}) não existe.");
        }

        $params = new ControllerParams;
        $params = $params->get($router);


        if (strtoupper(RequestType::get()) === "POST") {
            $reflection = new ReflectionClass($controller);

            $parameters = $reflection?->getMethod($method)?->getParameters();
            if ($parameters) {
                if ($parameters)
                    $requestFull = $parameters[0]?->getType()?->getName();

                $request = (new $requestFull());
                $response = $controller->$method($request, ...$params);
            } else
                $response = $controller->$method(...$params);
        } else
            $response = $controller->$method(...$params);


        if (!$response::$isString) redirect($response::$redirect);
        else echo $response::$isString;
    }
}
