<?php

/**
 * Responsible for adding messages to the "DyoxFy" array for viewing on view
 * @param string $message - The Message to display
 * @param string $type - The type of message
 * @return void
 */
function notification(string $message, string $type): void
{
    $_SESSION["dyoxfy"][] = [
        "type" => $type,
        "message" => $message
    ];
}


/**
 * Responsible display messages using js
 * @return void
 */
function dyoxfyStart(): void
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
