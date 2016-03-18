<?php

namespace ModernPUG\RedGooseSkin;

use Illuminate\Support\ServiceProvider;

class RedGooseSkinServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ncells');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/ncells'),
        ]);
    }

    public function register()
    {
    }
}
