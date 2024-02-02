<?php

namespace src\middlewares;

class need2BeLoggedIn
{
    function __construct()
    {
        $this->execute();
    }

    function execute()
    {
        $isLogged = isset($_SESSION["usuarioLogin"]);
        if (!$isLogged) {
            $routeLogin = URL_LOGIN;
            header("Location: {$routeLogin}");
            die;
        }
        return true;
    }
}
