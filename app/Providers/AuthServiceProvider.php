<?php

namespace App\Providers;

use App\Blog;
use App\Policies\BlogPolicy;
use App\Policies\RecruitPolicy;
use App\Policies\UserPolicy;
use App\Recruit;
use App\User;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Blog::class => BlogPolicy::class,
        User::class => UserPolicy::class,
        Recruit::class => RecruitPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });

        Gate::after(function (User $user, $ability) {
            return $user->hasRole('super-admin'); // note this returns boolean
        });
    }
}
