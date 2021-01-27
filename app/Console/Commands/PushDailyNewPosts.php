<?php

namespace App\Console\Commands;

use App\Services\Blog\PushDailyNewPosts as PushDailyNewPostsService;
use Illuminate\Console\Command;

class PushDailyNewPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:push-daily-new-article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '어제 등록된 신규 블로그 포스트를 슬랙으로 발송합니다.';

    /**
     * Execute the console command.
     *
     * @param  PushDailyNewPostsService  $pushDailyNewPosts
     * @return mixed
     */
    public function handle(PushDailyNewPostsService $pushDailyNewPosts)
    {
        $pushDailyNewPosts->pushSlack();
    }
}
