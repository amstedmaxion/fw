<?php

namespace src\controllers;

use Exception;
use PDOException;
use src\core\Response;
use src\services\ReportService;

class AppController extends Controller
{

    function index()
    {
        try {
            $srv = new ReportService;
            $listReserves = $srv->listReserves();

            dyoxfy("This is a message test from it", MESSAGE_SUCCESS);
            dyoxfy("This is a message test from it", MESSAGE_ERROR);
            dyoxfy("This is a message test from it", MESSAGE_INFO);
            dyoxfy("This is a message test from it", MESSAGE_WARNING);
            return Response::viewRender('report', $listReserves);            
        } catch (Exception $e) {
            dd($e);
        }
    }
}
