<?php

namespace App\Repositories;

use App\RepositorieInterface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function register($data, $user)
    {
        return $user::create($data);
    }

    public function UpdateUser($user)
    {
        return $user->save();
    }

    public function findUserById($user, $id)
    {
        return $user::find($id);
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }
    
}