<?php

namespace App\RepositorieInterface;

interface UserRepositoryInterface
{
    public function register($data, $user);
    public function login($data);
    public function logout($user);

    
}