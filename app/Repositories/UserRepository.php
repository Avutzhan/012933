<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function checkKey($key)
    {
        return User::where('remember_token', $key)->first();
    }
}
