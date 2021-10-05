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
    protected $description = '어제 등록된 신규 채용정보를 슬랙으로 발송합니다';

    /**
     * Execute the console command.
     *
     * @param  PushDailyNewRecruitsService  $pushReleaseNews
     * @return mixed
     */
    public function handle(PushDailyNewRecruitsService $pushReleaseNews)
    {
        $pushReleaseNews->pushSlack();
    }
}
