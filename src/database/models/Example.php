<?php

namespace src\database\models;

use src\database\Model;

class Example extends Model
{
    //Properties Query Builder
    public $table = 'tb_example';
    public $db = INTRANET_LATEST_HOMOLOGATION;

    //Properties database
    public int $id;
    public string $denomination;
    public string $cpv;
    public string $type;
    public string $created_at;
    public string $updated_at;
    public ?string $deleted_at;
    
    
    //Relations
    public $relations = [];    
}
