<?php

namespace App\Services\Blog\Rss;

use Zend\Feed\Reader\Feed\FeedInterface;
use Zend\Feed\Reader\Reader as ZendReader;

class FeedParser
{
    public function fromUrl(string $url): FeedInterface
    {
        $feed = ZendReader::import($url);

        return $feed;
    }
}
