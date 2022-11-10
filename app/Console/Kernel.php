<?php

namespace App\Console;

use App\Console\Commands\CrawlFeed;
use App\Console\Commands\CrawlReleaseNews;
use App\Console\Commands\Discord\UpdateChannelTagCommand;
use App\Console\Commands\Discord\UpdateThreadCommand;
use App\Console\Commands\Jumpit\RefreshRecruitCache;
use App\Console\Commands\PostImageUpdater;
use App\Console\Commands\PushDailyNewPosts;
use App\Console\Commands\PushDailyNewRecruits;
use App\Console\Commands\PushTodayReleaseNews;
use App\Console\Commands\UpdateWeeklyBestPosts;
use App\Console\Commands\User\UpdateGravatar;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(CrawlFeed::class)->hourly();
        $schedule->command(PostImageUpdater::class)->hourly();
        $schedule->command(CrawlReleaseNews::class)->hourly();
        $schedule->command(UpdateGravatar::class)->hourly();
        $schedule->command(UpdateWeeklyBestPosts::class)->weeklyOn(1, '7:00');
        //$schedule->command(PushWeeklyBestPosts::class)->weeklyOn(1, '7:00');
        $schedule->command(PushTodayReleaseNews::class)->dailyAt('7:05');
        $schedule->command(PushDailyNewPosts::class)->dailyAt('7:05');
        $schedule->command(PushDailyNewRecruits::class)->dailyAt('7:05');
        $schedule->command(RefreshRecruitCache::class)->hourly();
        $schedule->command(UpdateChannelTagCommand::class)->hourly();
        $schedule->command(UpdateThreadCommand::class)->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
