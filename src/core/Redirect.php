<?php

namespace src\core;

class Redirect
{

    public static $isString;
    public static $redirect;


    /**
     * This method is responsible for performing the URI REDIRECT
     * 
     * @param string $uri
     * @return Redirect
     */
    public static function to(string $uri): Redirect
    {
        self::$redirect = route($uri);
        return new static;
    }
}
