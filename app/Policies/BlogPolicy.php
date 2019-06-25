<?php

namespace App\Policies;

use App\Blog;
use App\Services\Rss\Exceptions\RequestNotOwnedBlogException;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Blog $blog)
    {

        if ($user->isNot($blog->owner)) {
            throw new RequestNotOwnedBlogException();
        }

        return true;

    }

    public function update(User $user, Blog $blog)
    {

        if ($user->isNot($blog->owner)) {
            throw new RequestNotOwnedBlogException();
        }

        return true;
    }

    public function destroy(User $user, Blog $blog)
    {

        if ($user->isNot($blog->owner)) {
            throw new RequestNotOwnedBlogException();
        }
        return true;

    }

    public function restore(User $user, Blog $blog)
    {

        if ($user->isNot($blog->owner)) {
            throw new RequestNotOwnedBlogException();
        }
        return true;

    }


}
