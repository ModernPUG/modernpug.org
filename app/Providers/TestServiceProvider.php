<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        TestResponse::macro('assertToastrHasSuccess', function () {
            /**
             * @var TestResponse $this
             */
            return $this->assertSessionHas('toastr::notifications.0.type', 'success');
        });

        TestResponse::macro('assertToastrHasError', function () {
            /**
             * @var TestResponse $this
             */
            return $this->assertSessionHas('toastr::notifications.0.type', 'error');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
