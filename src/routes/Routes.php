<?php


namespace src\routes;

use src\controllers\AppController;
use src\controllers\UserController;

$router = new Router;

$router->get('/', AppController::class, "welcome");
$router->get('/users', UserController::class, "index");
$router->get('/users/edit/[0-9a-zA-Z-]+', UserController::class, "edit");
$router->post('/users/update', UserController::class, "update");
$router->get('/users/create', UserController::class, "create");
$router->post('/users/store', UserController::class, "store");
$router->get("/users/delete/[0-9a-zA-Z-]+", UserController::class, "delete");

return $router->init();
