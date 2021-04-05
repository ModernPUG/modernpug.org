<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PointPolicy
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
        if ($user->can('point-list')) {
            return true;
        }

        return false;
    }
}
