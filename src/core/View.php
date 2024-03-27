<?php

namespace src\core;

use Exception;
use League\Plates\Engine;

class View
{

    public static $isString;
    public static $redirect;

    public static function render(string $view, array $data = []): self
    {
        $view = str_replace(".", "/", $view);
        $viewPath = "./src/views/{$view}.php";
        if (!file_exists($viewPath))
            throw new Exception("A view ({$view}) não existe");


        $templates = new Engine('./src/views');

        // $templates->addData([]);
        self::$isString = $templates->render(
            $view,
            $data
        );

        return new static;
    }
}
