<?php

namespace src\database\models;

use src\database\Model;

class Item extends Model
{
    //Properties Query Builder
    public $table = 'tb_testandoze';
    public $db = DATABASE_DEFAULT;

    //Properties database
    public int $id;
    public string $name;

    //Relations
    public $relations = [];
}
