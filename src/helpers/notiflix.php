<?php

function notiflixReport(string $title, string $message, string $button, string $type)
{
    if (!isset($_SESSION['notiflixReport'])) {
        $_SESSION['notiflixReport']['title'] = $title;
        $_SESSION['notiflixReport']['message'] = $message;
        $_SESSION['notiflixReport']['button'] = $button;
        $_SESSION['notiflixReport']['type'] = $type;
    }
}

function notiflixNotify(string $message, string $type)
{
    if (!isset($_SESSION['notiflixNotify'])) {
        $_SESSION['notiflixNotify']['type'] = $type;
        $_SESSION['notiflixNotify']['message'] = $message;
    }
}

function getNotiflix()
{
    if (isset($_SESSION['notiflixReport'])) {
        $title = $_SESSION['notiflixReport']['title'];
        $message = $_SESSION['notiflixReport']['message'];
        $button = $_SESSION['notiflixReport']['button'];
        $type = $_SESSION['notiflixReport']['type'];
        echo "<script>notiflix('{$title}', '{$message}', '{$button}', '{$type}')</script>";
        unset($_SESSION['notiflixReport']);
    }


    if (isset($_SESSION["notiflixNotify"])) {
        $message = $_SESSION['notiflixNotify']['message'];
        $type = $_SESSION['notiflixNotify']['type'];
        echo "<script>notiflixNotify('{$message}', '{$type}');</script>";
        unset($_SESSION["notiflixNotify"]);
    }
}
