<?php

namespace App\Policies;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the banners.
     *
     * @param  User  $user
     * @param  Banner  $banner
     * @return mixed
     */
    public function view(User $user, Banner $banner)
    {
        return true;
    }

    /**
     * Determine whether the user can create banners.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the banners.
     *
     * @param  User  $user
     * @param  Banner  $banner
     * @return mixed
     */
    public function update(User $user, Banner $banner)
    {
        if ($user->is($banner->create_user)) {
            return true;
        }

        if ($user->can('banner-edit')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the banners.
     *
     * @param  User  $user
     * @param  Banner  $banner
     * @return mixed
     */
    public function delete(User $user, Banner $banner)
    {
        if ($user->is($banner->create_user)) {
            return true;
        }

        if ($user->can('banner-delete')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the banners.
     *
     * @param  User  $user
     * @param  Banner  $banner
     * @return mixed
     */
    public function restore(User $user, Banner $banner)
    {
        if ($user->is($banner->create_user)) {
            return true;
        }

        if ($user->can('banner-restore')) {
            return true;
        }

        return false;
    }

    public function approve(User $user, Banner $banner)
    {
        if ($user->can('banner-allow')) {
            return true;
        }

        return false;
    }

    public function disapprove(User $user, Banner $banner)
    {
        if ($user->can('banner-disallow')) {
            return true;
        }

        return false;
    }
}
