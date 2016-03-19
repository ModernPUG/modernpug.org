<?php

namespace ModernPUG\Homepage;

use App;
use Illuminate\Support\ServiceProvider;
use ModernPUG\Homepage\Console\ChangeSkinCommand;
use ModernPUG\Homepage\Console\RandomSkinCommand;

class HomepageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRandomSkinCommand();
        $this->registerChangeSkinCommand();
    }

    public function registerRandomSkinCommand()
    {
        $this->app->singleton('command.modernpug.skin.random', function () {
            return new RandomSkinCommand();
        });

        $this->commands('command.modernpug.skin.random');
    }

    public function registerChangeSkinCommand()
    {
        $this->app->singleton('command.modernpug.skin.change', function () {
            return new ChangeSkinCommand();
        });

        $this->commands('command.modernpug.skin.change');
    }
}
