<?php

namespace App\Console\Commands;

use App\Services\ReleaseNews\Updater;
use Illuminate\Console\Command;

class CrawlReleaseNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'release-news:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '릴리즈 뉴스 정보가 있는 사이트를 크롤링합니다.';

    /**
     * Execute the console command.
     *
     * @param Updater $updater
     * @return mixed
     * @throws \Exception
     */
    public function handle(Updater $updater) {
        $updater->update();
    }
}
