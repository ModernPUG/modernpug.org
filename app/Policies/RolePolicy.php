<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the recruits.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user)
    {
        if ($user->can('role-list')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create recruits.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('role-create')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the recruits.
     *
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        if ($user->can('role-edit')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the recruits.
     *
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if ($user->can('role-delete')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the recruits.
     *
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        if ($user->can('role-restore')) {
            return true;
        }

        return false;
    }
}
