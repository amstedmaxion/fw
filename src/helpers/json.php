<?php

/**
 * Its responsible for verify if string is json or not
 *
 * @param string $data
 * @return object|boolean
 */
function isJson(string $data)
{
    $r = json_decode($data);
    if (json_last_error() === JSON_ERROR_NONE)
        return $r;
    else
        return null;
}


/**
 * Its responsible for print a json
 *
 * @param array|object
 * @return void
 */
function response_json(array|object $array)
{
    return json_encode($array);
}