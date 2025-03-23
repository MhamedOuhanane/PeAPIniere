<?php

namespace App\RepositorieInterface;

interface RoleRepositoryInterface
{
    public function FindRoleById($id);
    public function FindRoleByName($Name);
}