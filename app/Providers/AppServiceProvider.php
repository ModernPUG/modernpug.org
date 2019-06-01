<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(\JoliCode\Slack\Api\Client::class,function(){
            return \JoliCode\Slack\ClientFactory::create(config('slack.token'));
        });
    }
}
