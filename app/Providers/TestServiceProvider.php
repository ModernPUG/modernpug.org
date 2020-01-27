<?php

namespace App\Providers;

use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        TestResponse::macro('assertToastrHasSuccess', function () {
            return $this->assertSessionHas('toastr::notifications.0.type', 'success');
        });

        TestResponse::macro('assertToastrHasError', function () {
            return $this->assertSessionHas('toastr::notifications.0.type', 'error');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
