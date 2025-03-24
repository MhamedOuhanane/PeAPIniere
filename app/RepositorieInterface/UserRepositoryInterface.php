<?php

namespace App\RepositorieInterface;

interface UserRepositoryInterface
{
    public function register($data, $user);

    public function UpdateUser($user);
    public function deleteUser($user);
    public function findUserById($user, $id);


}