<?php



use src\core\Router;

require './vendor/autoload.php';
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

if (empty($_SESSION)) {
    if ($_SERVER['SERVER_NAME'] !== 'localhost' and $_SERVER['SERVER_NAME'] !== '192.168.44.252') {
        $random_hex = bin2hex(random_bytes(18));
        session_id($random_hex);
    }
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION['app_started'] = 1;
}

if (DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

Router::run();
