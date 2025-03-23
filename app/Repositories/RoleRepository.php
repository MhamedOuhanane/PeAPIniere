<?php

namespace App\Repositories;

use App\Models\Role;
use App\RepositorieInterface\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function FindRoleById($id)
    {
        return Role::find($id);
    }

    public function FindRoleByName($Name)
    {
        return Role::where('name', $Name)->first();
    }

}