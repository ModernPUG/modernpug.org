<?php

namespace Tests\Mock;

use App\Services\Rss\PostUpdater;

trait PostUpdaterMock
{
    use TagConverterMock;

    /**
     * @return PostUpdater
     */
    private function getPostUpdaterMock(): PostUpdater
    {
        $mock = \Mockery::mock(PostUpdater::class);
        $mock->shouldReceive('fromFeed');

        return $mock;
    }
}
