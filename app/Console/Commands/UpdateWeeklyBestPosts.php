<?php

namespace App\Console\Commands;

use App\Services\Blog\PushWeeklyBestPosts;
use App\Services\Post\WeeklyBestUpdater;
use Illuminate\Console\Command;

class UpdateWeeklyBestPosts extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'posts:update-weekly-best';

    /**
     * The console command description.
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @param  WeeklyBestUpdater  $weeklyBestUpdater
     * @param  PushWeeklyBestPosts  $pushWeeklyBestPosts
     */
    public function handle(
        WeeklyBestUpdater $weeklyBestUpdater,
        PushWeeklyBestPosts $pushWeeklyBestPosts
    ) {
        $weeklyBestUpdater->update();
        $pushWeeklyBestPosts->pushSlack();
    }
}
