<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BlogFeedUpdater;

class CrawlFeed extends Command
{
    protected $name = 'feed:crawl';

    protected $description = 'RSS를 긁어온다.';

    public function handle(BlogFeedUpdater $reader)
    {
        $reader->updateAllBlog();
    }
}
