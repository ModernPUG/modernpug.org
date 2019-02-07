<?php

namespace App\Console\Commands;

use App\Services\ReleaseNews\Updater;
use Illuminate\Console\Command;

class CrawlRelease extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'release:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '릴리즈 정보가 있는 사이트를 크롤링합니다.';

    /**
     * Execute the console command.
     *
     * @param App\Services\ReleaseNewsService $rs
     * @return mixed
     */
    public function handle(Updater $updater) {
        $updater->update();
    }
}
