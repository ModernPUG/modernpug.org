<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Recruit;
use App\Models\User;
use App\Policies\BlogPolicy;
use App\Policies\RecruitPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Blog::class => BlogPolicy::class,
        User::class => UserPolicy::class,
        Recruit::class => RecruitPolicy::class,
    ];

    public function boot(): void
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
