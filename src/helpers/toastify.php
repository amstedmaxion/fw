<?php

function toast(string $message, string $type)
{
    if (!isset($_SESSION['toastify'])) {
        $_SESSION['toastify']['color'] = $type;
        $_SESSION['toastify']['message'] = $message;
    }
}


function getToasts()
{
    if (isset($_SESSION['toastify'])) {
        $color = $_SESSION['toastify']['color'];
        $message = $_SESSION['toastify']['message'];
        echo "<script>toast('{$message}', '{$color}')</script>";
        unset($_SESSION['toastify']);
    }
}
