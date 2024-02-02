<?php

namespace src\core;

use Exception;
use League\Plates\Engine;

class Response
{

    public static $isString;
    public static $redirect;


    /**
     * This method is responsible for configuring the isString variable with JSON
     * 
     * @param array|object Content that will be converted to JSON
     * @return self
     */
    public static function json(array|object $data, int $statusCode): self
    {
        http_response_code($statusCode);
        self::$isString = response_json($data);
        return new static;
    }


    /**
     * This method is responsible for performing the URI REDIRECT
     * 
     * @param string $uri
     * @return void;
     */
    public static function redirect(string $uri): void
    {
        redirect(route($uri));
    }


    /**
     * Method responsible for setting up the settings for the Return URL
     * 
     * @return self
     */
    public static function back(string $params = null): self
    {
        self::$isString = false;
        self::$redirect = url_back() . $params;
        return new static;
    }

    /**
     * This method rendering a view
     *
     * @param string $view path into directory view
     * @param array $data this array represents the data that will access in view
     * @return self
     */
    public static function viewRender(string $view, array $data = []): self
    {

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
