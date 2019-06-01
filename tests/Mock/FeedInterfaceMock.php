<?php

namespace Tests\Mock;

use Zend\Feed\Reader\Feed\FeedInterface;

trait FeedInterfaceMock
{
    use EntryInterfaceMock;

    /**
     * @return \Mockery\MockInterface|FeedInterface
     */
    private function getFeedInterFaceMock()
    {
        $entryMock = $this->getEntryInterfaceMock();

        $feedInterfaceMock = \Mockery::mock(FeedInterface::class);
        $feedInterfaceMock->shouldReceive('getTitle')->andReturn('테스트 타이틀');
        $feedInterfaceMock->shouldReceive('getLink')->andReturn('http://test.com');
        $feedInterfaceMock->shouldReceive('getDescription')->andReturn('테스트 설명');

        $items = [
            $entryMock,
        ];
        $this->mockArrayIterator($feedInterfaceMock, $items);

        return $feedInterfaceMock;
    }
}
