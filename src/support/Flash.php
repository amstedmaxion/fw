<?php

namespace src\support;

class Flash
{
    public static function set(string $index, string $value)
    {
        $_SESSION['isWrong'][$index] = $value;
    }

    public static function get(string $index)
    {
        if (isset($_SESSION['isWrong'][$index])) {
            $value = $_SESSION['isWrong'][$index];
            unset($_SESSION['isWrong'][$index]);

            return $value;
        }

        return null;
    }
}
