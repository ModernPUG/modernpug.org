<?php

namespace Tests\Mock;

use Zend\Feed\Reader\Entry\EntryInterface;

trait EntryInterfaceMock
{
    private function getEntryInterfaceMock()
    {
        $entryMock = \Mockery::mock(EntryInterface::class);
        $entryMock->shouldReceive('getTitle')->andReturn('Rss 타이틀');
        $entryMock->shouldReceive('getDescription')->andReturn('Rss 본문');
        $entryMock->shouldReceive('getLink')->andReturn('http://test.com/1');
        $entryMock->shouldReceive('getDateModified')->andReturn(date('Y-m-d H:i:s'));
        $entryMock->shouldReceive('getCategories')->andReturn([
            ['label'=>'php'], ['label'=>'js'],
        ]);

        return $entryMock;
    }
}
