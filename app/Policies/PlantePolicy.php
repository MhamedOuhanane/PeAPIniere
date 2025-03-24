<?php

namespace App\Policies;

use App\Models\Plante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Plante $plante): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->name === 'admine';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Plante $plante): bool
    {
        return $user->role->name === 'admine';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Plante $plante): bool
    {
        return $user->role->name === 'admine';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Plante $plante): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Plante $plante): bool
    {
        return false;
    }
}
