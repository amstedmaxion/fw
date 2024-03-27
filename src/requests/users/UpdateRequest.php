<?php

namespace src\requests\users;

use src\requests\Request;

class UpdateRequest extends Request
{
    protected $rules = [
        "id" => "required",
        "name" => "required",
        "age" => "required",
    ];

    function __construct()
    {
        $this->execute();
    }
}
