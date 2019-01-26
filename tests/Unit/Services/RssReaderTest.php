<?php


namespace Tests\Unit\Services;


use App\Services\BlogFeedUpdater;
use Tests\Mock\PostUpdaterMock;
use Tests\Mock\BlogUpdaterMock;
use Tests\Mock\FeedParserMock;
use Tests\TestCase;

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