<?php

namespace src\database;

class Model
{
    public function fill(array $data)
    {
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
        return $this;
    }
}
