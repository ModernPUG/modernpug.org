<?php

namespace App\Policies;

use App\Blog;
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

        return false;
    }

    public function update(User $user, Blog $blog)
    {
        if ($user->is($blog->owner)) {
            return true;
        }

        if ($user->can('blog-edit')) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Blog $blog)
    {
        if ($user->is($blog->owner)) {
            return true;
        }

        if ($user->can('blog-delete')) {
            return true;
        }

        return false;
    }

    public function restore(User $user, Blog $blog)
    {
        if ($user->is($blog->owner)) {
            return true;
        }

        if ($user->can('blog-restore')) {
            return true;
        }

        return false;
    }
}
