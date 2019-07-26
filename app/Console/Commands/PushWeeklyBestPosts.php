<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PushWeeklyBestPosts extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'posts:push-slack';

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
     * @param \App\Services\Blog\PushWeeklyBestPosts $pushWeeklyBestPosts
     */
    public function handle(\App\Services\Blog\PushWeeklyBestPosts $pushWeeklyBestPosts)
    {
        $pushWeeklyBestPosts->pushSlack();
    }
}
