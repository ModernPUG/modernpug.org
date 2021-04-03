<?php

namespace Tests;

use Clockwork\Support\Laravel\Tests\UsesClockwork;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery\MockInterface;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UsesClockwork;

    protected function setUp(): void
    {
        parent::setUp();
        if (config('clockwork.tests.collect')) {
            $this->setUpClockwork();
        }
    }

    protected function mockArrayIterator(MockInterface $mock, array $items)
    {
        if ($mock instanceof \ArrayAccess) {
            foreach ($items as $key => $val) {
                $mock->shouldReceive('offsetGet')
                    ->with($key)
                    ->andReturn($val);
                $mock->shouldReceive('offsetExists')
                    ->with($key)
                    ->andReturn(true);
            }
            $mock->shouldReceive('offsetExists')
                ->andReturn(false);
        }
        if ($mock instanceof \Iterator) {
            $counter = 0;
            $mock->shouldReceive('rewind')
                ->andReturnUsing(function () use (&$counter) {
                    $counter = 0;
                });
            $vals = array_values($items);
            $keys = array_values(array_keys($items));
            $mock->shouldReceive('valid')
                ->andReturnUsing(function () use (&$counter, $vals) {
                    return isset($vals[$counter]);
                });
            $mock->shouldReceive('current')
                ->andReturnUsing(function () use (&$counter, $vals) {
                    return $vals[$counter];
                });
            $mock->shouldReceive('key')
                ->andReturnUsing(function () use (&$counter, $keys) {
                    return $keys[$counter];
                });
            $mock->shouldReceive('next')
                ->andReturnUsing(function () use (&$counter) {
                    $counter++;
                });
        }
        if ($mock instanceof \Countable) {
            $mock->shouldReceive('count')
                ->andReturn(count($items));
        }
    }
}
