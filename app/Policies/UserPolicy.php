<?php

namespace App\Policies;

use App\Post;
use App\User;
use App\Services\User\Exceptions\UserPolicyException;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function view(User $user, User $routeUser=null)
    {
        if ($user->can('user-list')) {
            return true;
        }

        throw new UserPolicyException('사용자를 조회 할 권한이 없습니다');
    }

    public function create(User $user)
    {
        return true;
    }

    public function edit(User $user, User $routeUser)
    {

        if ($user->is($routeUser)) {
            return true;
        }


        if ($user->can('user-edit')) {
            return true;
        }


        throw new UserPolicyException('사용자를 수정할 권한이 없습니다');

    }

    public function update(User $user, User $routeUser)
    {

        if ($user->is($routeUser)) {
            return true;
        }

        if ($user->can('user-edit')) {
            return true;
        }

        throw new UserPolicyException('사용자를 수정 할 권한이 없습니다');
    }

    public function delete(User $user, User $routeUser)
    {

        if ($user->is($routeUser)) {
            return true;
        }

        if ($user->can('user-delete')) {
            return true;
        }

        throw new UserPolicyException('사용자를 삭제 할 권한이 없습니다');

    }

    public function restore(User $user, User $routeUser)
    {

        if ($user->is($routeUser)) {
            return true;
        }

        if ($user->can('user-restore')) {
            return true;
        }

        throw new UserPolicyException('사용자를 복구 할 권한이 없습니다');

    }


}
