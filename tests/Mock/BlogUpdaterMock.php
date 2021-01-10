<?php

namespace Tests\Mock;

use App\Services\Blog\Rss\BlogUpdater;
use Mockery;

trait BlogUpdaterMock
{
    /**
     * @return BlogUpdater
     */
    private function getBlogUpdaterMock(): BlogUpdater
    {
        $mock = Mockery::mock(BlogUpdater::class);
        $mock->shouldReceive('fromFeed');

        return $mock;
    }
}
