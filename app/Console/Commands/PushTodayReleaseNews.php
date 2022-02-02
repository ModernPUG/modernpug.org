<?php

namespace App\Console\Commands;

use App\Services\ReleaseNews\PushReleaseNews;
use Illuminate\Console\Command;

class PushTodayReleaseNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'release-news:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '릴리즈 뉴스 정보를 슬랙 푸시 알림을 전송합니다.';

    /**
     * Execute the console command.
     *
     * @param  PushReleaseNews  $pushReleaseNews
     * @return mixed
     */
    public function handle(PushReleaseNews $pushReleaseNews)
    {
        $pushReleaseNews->pushSlack();
    }
}
