<?php

namespace src\support;

use Exception;

class Error
{
    private string $error;

    public function __construct(string $error)
    {
        $this->setError($error);
        return $this;
    }

    public function setError(string $error)
    {
        if (!$error) throw new Exception("Necessary to inform the type of error");
        $this->error = $error;
    }
    public function getError()
    {
        return $this->error;
    }
}
