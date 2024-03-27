<?php

/**
 * This method is responsible for verifying that the application is in the production host
 * 
 * @return boolean If you are at host 0.94 or not
 */
function isProduction()
{
    $production = ["172.30.0.94"];
    return in_array($_SERVER['HTTP_HOST'], $production);
}


