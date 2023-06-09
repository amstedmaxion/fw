<?php

use src\support\Flash;

function flash(string $index, string $class = '')
{
    $message = Flash::get($index);
    return "<span class='{$class}'>{$message}</span>";
}
