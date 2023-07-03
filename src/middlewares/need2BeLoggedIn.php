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
        $estaLogado = false;
        if (!$estaLogado) {
            echo "redirecionar para a página inicial";
            die;
        }
        return true;
    }
}
