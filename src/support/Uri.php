<?php

namespace src\support;

class Uri
{
    public static function get()
    {
        $uri = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
        $uri = array_filter($uri);
        unset($uri[1], $uri[2]);
        return $uri = '/' . implode('/', $uri);
    }
}
