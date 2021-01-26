<?php

namespace App\Console\Commands;

use App\Services\Recruits\PushDailyNewRecruits as PushDailyNewRecruitsService;
use Illuminate\Console\Command;

class PushDailyNewRecruits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:push-daily-new-recruits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '릴리즈 뉴스 정보를 슬랙 푸시 알림을 전송합니다.';

    /**
     * Execute the console command.
     *
     * @param PushDailyNewRecruitsService $pushReleaseNews
     * @return mixed
     */
    public function handle(PushDailyNewRecruitsService $pushReleaseNews)
    {
        $pushReleaseNews->pushSlack();
    }
}
