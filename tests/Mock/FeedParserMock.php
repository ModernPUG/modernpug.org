<?php

namespace Tests\Mock;

use App\Services\Blog\Rss\FeedParser;

trait FeedParserMock
{
    use FeedInterfaceMock;

    private function getFeedParserMock()
    {
        $feedInterfaceMock = $this->getFeedInterFaceMock();

        $feedParserMock = \Mockery::mock(FeedParser::class);
        $feedParserMock->shouldReceive('fromUrl')->andReturn($feedInterfaceMock);

        return $feedParserMock;
    }
}
