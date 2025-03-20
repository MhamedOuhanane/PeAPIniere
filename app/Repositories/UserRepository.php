<?php

namespace App\Repositories;

use App\RepositorieInterface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function register($data, $user)
    {
        return $user->create($data);
    }

    public function login($data)
    {

    }

    public function logout($user)
    {

    }

}