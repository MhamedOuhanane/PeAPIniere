<?php

namespace App\Repositories;

use App\RepositorieInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUser()
    {
        return DB::table('users')
                    ->get();
    }

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