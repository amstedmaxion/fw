<?php

use src\core\Router;

/**
 * This method is responsible for setting up the application zone team to Brazil
 * @return void
 */
function setTimezone(): void
{
    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
}

/**
 * This method is responsible for configuring whether or not the errors should appear
 * Recommended to use the development of the application
 * 
 * @return void
 */
function setDebug(): void
{
    if (DEBUG) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}

/**
 * This method is responsible for start routes
 * 
 * @return void
 */
function startRouter(): void
{
    Router::run();
}
