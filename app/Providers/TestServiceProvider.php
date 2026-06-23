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
            return $this->assertSessionHas('flasher::envelopes', function (array $envelopes) {
                return $this->hasToastrEnvelope($envelopes, 'success');
            });
        });

        TestResponse::macro('assertToastrHasError', function () {
            /**
             * @var TestResponse $this
             */
            return $this->assertSessionHas('flasher::envelopes', function (array $envelopes) {
                return $this->hasToastrEnvelope($envelopes, 'error');
            });
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

    private function hasToastrEnvelope(array $envelopes, string $type): bool
    {
        foreach ($envelopes as $envelope) {
            $envelope = is_string($envelope) ? @unserialize($envelope) : $envelope;

            if (! is_object($envelope) || ! method_exists($envelope, 'getNotification')) {
                continue;
            }

            if ($envelope->getNotification()->getType() === $type) {
                return true;
            }
        }

        return false;
    }
}
