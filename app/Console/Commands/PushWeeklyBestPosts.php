<?php

namespace App\Console\Commands;

use App\Services\Blog\PushWeeklyBestPosts as PushWeeklyBestPostsService;
use Illuminate\Console\Command;

class PushWeeklyBestPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:push-weekly-best';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  PushWeeklyBestPostsService  $pushWeeklyBestPosts
     */
    public function handle(PushWeeklyBestPostsService $pushWeeklyBestPosts)
    {
        $pushWeeklyBestPosts->pushSlack();
    }
}
