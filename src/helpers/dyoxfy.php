<?php


function dyoxfy(string $message, string $type)
{
    $_SESSION["dyoxfy"][] = [
        "type" => $type,
        "message" => $message
    ];
}

function dyoxfyStart()
{
    if (isset($_SESSION["dyoxfy"])) {
        foreach ($_SESSION["dyoxfy"] as $toastKey => $toast) {
            $message = $toast['message'];
            $type = $toast['type'];
            $time = $toastKey * 1000;
            echo "<script>
                setTimeout(() => dyoxfy('{$type}', '{$message}'), $time)
            </script>";
        }
        unset($_SESSION["dyoxfy"]);
    }
}
