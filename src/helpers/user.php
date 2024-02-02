<?php

function user(string $key)
{
    $key = ($key === "key") ? "matricula" : $key;
    $sessionUser = getSession("user");
    return $sessionUser[$key] ?? null;
}
