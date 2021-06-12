<?php

namespace App\Services\Blog\Rss;

use Laminas\Feed\Reader\Feed\FeedInterface;
use Laminas\Feed\Reader\Reader as LaminasReader;

class FeedParser
{
    public function fromUrl(string $url): FeedInterface
    {
        $feed = LaminasReader::import($url);

        return $feed;
    }
}
