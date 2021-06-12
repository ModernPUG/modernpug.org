<?php

namespace App\Services\Blog\Rss;

use App\Models\Blog;
use Laminas\Feed\Reader\Feed\FeedInterface;

class BlogUpdater
{
    public function fromFeed(FeedInterface $feed, Blog $blog)
    {
        $blog->title = $feed->getTitle();
        $blog->site_url = $feed->getId();
        $blog->description = $feed->getDescription();
        $blog->save();
    }
}
