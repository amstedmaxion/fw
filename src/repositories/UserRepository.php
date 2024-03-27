<?php

namespace src\repositories;

use src\database\models\User;

class UserRepository extends Repository
{
    public function __construct(User $user = null)
    {
        $this->setModel($user ?? (new User));
    }
}
