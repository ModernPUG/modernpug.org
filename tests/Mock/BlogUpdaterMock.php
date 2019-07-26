<?php

namespace Tests\Mock;

use App\Services\Blog\Rss\BlogUpdater;

trait BlogUpdaterMock
{
    /**
     * @return BlogUpdater
     */
    private function getBlogUpdaterMock(): BlogUpdater
    {
        $mock = \Mockery::mock(BlogUpdater::class);
        $mock->shouldReceive('fromFeed');

        return $mock;
    }
}
