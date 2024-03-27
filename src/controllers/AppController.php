<?php

namespace src\controllers;

use Exception;
use src\core\View;

class AppController extends Controller
{

    /**
     * This function is the entry point of the application.
     * @return View
     */
    function welcome(): View
    {
        try {
            return View::render('app.welcome');
        } catch (Exception $e) {
            dd($e);
        }
    }
}
