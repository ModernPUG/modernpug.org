<?php

namespace App\Console\Commands;

use App\Services\Blog\BlogFeedUpdater;
use Illuminate\Console\Command;

class CrawlFeed extends Command
{
    protected $name = 'feed:crawl';

    protected $description = 'RSS를 긁어온다.';

    public function handle(BlogFeedUpdater $reader)
    {
        $reader->updateAllBlog();
    }
}
