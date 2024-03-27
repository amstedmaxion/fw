<?php

namespace src\requests\users;

use src\requests\Request;

class StoreRequest extends Request
{
    protected $rules = [
        "name" => "required",
        "age" => "required",
    ];

    function __construct()
    {
        $this->execute();
    }
}
