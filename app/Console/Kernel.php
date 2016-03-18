<?php

namespace App\Console;

use Artisan;
use Storage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () use ($schedule) {
            $this->rrmdir(resource_path('views/vendor/ncells'));
            $provider = array_rand([
                'ModernPUG\OriginalSkin\OriginalSkinServiceProvider',
                'ModernPUG\RedGooseSkin\RedGooseSkinServiceProvider',
            ]);
            Artisan::call('vendor:publish', ['--provider' => $provider]);
        })->everyMinute();
    }

    private function rrmdir($dirPath)
    {
        $paths = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $dirPath,
                \FilesystemIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($paths as $path) {
            $path->isDir() && !$path->isLink() ? rmdir($path->getPathname()) : unlink($path->getPathname());
        }
        
        rmdir($dirPath);
    }
}
