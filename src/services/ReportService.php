<?php

namespace src\services;

use Exception;
use src\database\models\Item;
use src\repositories\ReportRepository;

class ReportService{
    protected $reportRepository;

    function __construct()
    {
        $this->reportRepository = new ReportRepository();
    }

    // function salvar(array $data) {
    //     $name = strtolower($data['name']);
    //     if (!$this->zeRepository->setModel((new Item)->fill(['name' => $name]))->save()) {
    //         throw new Exception("Error Processing Request", 400);
    //     }
    // }

    // function listar() {
    //     return $this->zeRepository->allWithPaginate();
    // }

    // function atualizar(array $data) {
    //     $name = strtolower($data['name']);
    //     if (!$this->zeRepository->setModel((new Item)->fill(['id' => 3,'name' => $name]))->save()) {
    //         throw new Exception("Error Processing Request", 400);
    //     }
    // }

    // function destroy(array $data) {
    //     if (!$this->zeRepository->setModel((new Item)->fill($data))->destroy()) {
    //         throw new Exception("Error Processing Request", 400);
    //     }
    // }

    function listReserves() {
        return $this->reportRepository->listReserves();
    }
}