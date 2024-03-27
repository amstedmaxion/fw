<?php

namespace src\database\models;

use src\database\Model;

class User extends Model
{
    //Properties Query Builder
    public $table = 'tb_welcome_to_framework';
    public $db = DATABASE_DEFAULT;

    //Properties database
    public string $id;
    public string $name;
    public string $age;

    public string $created_at;
    public string $updated_at;
    public ?string $deleted_at;
}
