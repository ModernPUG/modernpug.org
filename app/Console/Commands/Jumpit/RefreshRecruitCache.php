<?php

namespace App\Console\Commands\Jumpit;

use App\Services\Jumpit\CachedRecruit;
use Illuminate\Console\Command;

class RefreshRecruitCache extends Command
{
    protected $signature = 'jumpit:refresh-recruits';

    protected $description = 'Jumpit의 채용공고 데이터를 갱신합니다.';

    public function handle(CachedRecruit $cachedRecruit)
    {
        $cachedRecruit->setCache();
    }
}
