<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Tests\Mock\FeedParserMock;
use Tests\Mock\BlogUpdaterMock;
use Tests\Mock\PostUpdaterMock;
use App\Services\BlogFeedUpdater;

class RssReaderTest extends TestCase
{
    use FeedParserMock;
    use BlogUpdaterMock;
    use PostUpdaterMock;

    public function testSuccessRequest()
    {
        $rssReader = new BlogFeedUpdater($this->getFeedParserMock(),
            $this->getBlogUpdaterMock(),
            $this->getPostUpdaterMock()
        );

        $rssReader->updateAllBlog();
    }
}
