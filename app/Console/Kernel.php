<?php

namespace App\Console;

use App\Console\Commands\CrawlFeed;
use App\Console\Commands\CrawlReleaseNews;
use App\Console\Commands\PostImageUpdater;
use App\Console\Commands\PushTodayReleaseNews;
use App\Console\Commands\PushWeeklyBestPosts;
use App\Console\Commands\User\UpdateGravatar;
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
        CrawlFeed::class,
        CrawlReleaseNews::class,
        PostImageUpdater::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(CrawlFeed::class)->hourly();
        $schedule->command(PostImageUpdater::class)->hourly();
        $schedule->command(CrawlReleaseNews::class)->hourly();
        $schedule->command(UpdateGravatar::class)->hourly();
        $schedule->command(PushWeeklyBestPosts::class)->weeklyOn(1, '7:00');
        $schedule->command(PushTodayReleaseNews::class)->dailyAt('7:05');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
