<?php

namespace App\Policies;

use App\Services\Recruits\Exceptions\RecruitPolicyException;
use App\Services\Rss\Exceptions\BlogPolicyException;
use App\User;
use App\Recruit;
use Illuminate\Auth\Access\HandlesAuthorization;
use Toastr;

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

        Toastr::error('채용공고를 수정 할 권한이 없습니다');
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

        Toastr::error('채용공고를 삭제 할 권한이 없습니다');
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

        Toastr::error('채용공고를 복구 할 권한이 없습니다');
        return false;
    }

}
