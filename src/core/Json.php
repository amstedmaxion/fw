<?php

namespace src\core;


class Json
{
    public static $isString;


    /**
     * This method is responsible for configuring the isString variable with JSON
     * 
     * @param array|object Content that will be converted to JSON
     * @return self
     */
    public static function return(array|object $data, int $statusCode): self
    {
        http_response_code($statusCode);
        self::$isString = json_encode($data);
        return new static;
    }
}
