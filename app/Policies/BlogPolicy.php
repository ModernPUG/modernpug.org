<?php

namespace App\Policies;

use App\Blog;
use App\Services\Rss\Exceptions\BlogPolicyException;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;


    public function create(User $user)
    {
        return true;
    }

    public function edit(User $user, Blog $blog)
    {

        if ($user->is($blog->owner)) {
            return true;
        }


        if ($user->can('blog-edit')) {
            return true;
        }


        throw new BlogPolicyException('블로그를 수정할 권한이 없습니다');

    }

    public function update(User $user, Blog $blog)
    {

        if ($user->is($blog->owner)) {
            return true;
        }

        if ($user->can('blog-edit')) {
            return true;
        }

        throw new BlogPolicyException('블로그를 수정 할 권한이 없습니다');
    }

    public function delete(User $user, Blog $blog)
    {

        if ($user->is($blog->owner)) {
            return true;
        }

        if ($user->can('blog-delete')) {
            return true;
        }

        throw new BlogPolicyException('블로그를 삭제 할 권한이 없습니다');

    }

    public function restore(User $user, Blog $blog)
    {

        if ($user->is($blog->owner)) {
            return true;
        }

        if ($user->can('blog-restore')) {
            return true;
        }

        throw new BlogPolicyException('블로그를 복구 할 권한이 없습니다');

    }


}
