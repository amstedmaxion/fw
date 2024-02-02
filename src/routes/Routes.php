<?php


namespace src\routes;

use src\controllers\AppController;
use src\controllers\ExitController;
use src\controllers\PackingController;
use src\controllers\ReceiptController;
use src\controllers\ReportController;
use src\routes\BaseRouter;

$router = new BaseRouter;

$router->get('/', AppController::class, 'index');

return $router->init();
