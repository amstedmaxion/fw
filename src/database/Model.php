<?php

namespace src\database;

class Model
{
    /**
     * Method responsible for filling the model attributes according to the informed array
     * 
     * @param array $data - indexed content that will be filled as attributes of the model
     * 
     * @return self
     */
    public function fill(array $data): self
    {
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
        return $this;
    }
}
