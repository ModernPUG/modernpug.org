<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $routeUser = null)
    {
        if ($user->can('user-list')) {
            return true;
        }

        return false;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, User $routeUser)
    {
        if ($user->is($routeUser)) {
            return true;
        }

        if ($user->can('user-edit')) {
            return true;
        }

        return false;
    }

    public function delete(User $user, User $routeUser)
    {
        if ($user->is($routeUser)) {
            return true;
        }

        if ($user->can('user-delete')) {
            return true;
        }

        return false;
    }

    public function restore(User $user, User $routeUser)
    {
        if ($user->is($routeUser)) {
            return true;
        }

        if ($user->can('user-restore')) {
            return true;
        }

        return false;
    }
}
