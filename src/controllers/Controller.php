<?php

namespace src\controllers;

use Exception;
use League\Plates\Engine;

abstract class Controller
{
    /**
     * This method rendering a view
     *
     * @param string $view path into directory view
     * @param array $data this array represents the data that will access in view
     * @return void
     */
    protected function view(string $view, array $data = []): void
    {
        $viewPath = "./src/views/{$view}.php";
        if (!file_exists($viewPath)) 
            throw new Exception("A view ({$view}) não existe");

        $templates = new Engine('./src/views');

        // $templates->addData([]);
        echo $templates->render(
            $view,
            $data
        );
    }
}
