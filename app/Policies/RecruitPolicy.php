<?php

namespace App\Policies;

use App\Recruit;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecruitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the recruits.
     *
     * @param User $user
     * @param Recruit $recruit
     * @return mixed
     */
    public function view(User $user, Recruit $recruit)
    {
        return true;
    }

    /**
     * Determine whether the user can create recruits.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the recruits.
     *
     * @param User $user
     * @param Recruit $recruit
     * @return mixed
     */
    public function update(User $user, Recruit $recruit)
    {
        if ($user->is($recruit->entry_user)) {
            return true;
        }

        if ($user->can('recruit-edit')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the recruits.
     *
     * @param User $user
     * @param Recruit $recruit
     * @return mixed
     */
    public function delete(User $user, Recruit $recruit)
    {
        if ($user->is($recruit->entry_user)) {
            return true;
        }

        if ($user->can('recruit-delete')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the recruits.
     *
     * @param User $user
     * @param Recruit $recruit
     * @return mixed
     */
    public function restore(User $user, Recruit $recruit)
    {
        if ($user->is($recruit->entry_user)) {
            return true;
        }

        if ($user->can('recruit-restore')) {
            return true;
        }

        return false;
    }
}
