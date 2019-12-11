<?php

namespace Tests\Unit\Services;

use App\Services\Slack\Inviter;
use Tests\TestCase;

class SlackInviterTest extends TestCase
{
    public function testSuccessRequest()
    {
        $mock = $this->getSuccessMock();
        $inviter = new Inviter($mock);

        $inviter->invite('test@test.com');
    }

    private function getSuccessMock()
    {
        $body = <<<'EOF'
{"ok":true}
EOF;

        /** @var \Mockery\MockInterface|\GuzzleHttp\Psr7\Response $responseMock */
        $responseMock = \Mockery::mock(\GuzzleHttp\Psr7\Response::class);
        $responseMock->shouldReceive('getContents')->andReturn($body);
        $responseMock->shouldReceive('getStatusCode')->andReturn(200);
        $responseMock->shouldReceive('getHeader')->andReturn(['Content-Type' => 'json']);
        $responseMock->shouldReceive('getBody')->andReturn($responseMock);

        /** @var \Mockery\MockInterface|\GuzzleHttp\Client $requestMock */
        $requestMock = \Mockery::mock(\GuzzleHttp\Client::class);
        $requestMock->shouldReceive('request')->andReturn($responseMock);

        return $requestMock;
    }

    public function testFailRequest()
    {
        $this->expectException(\App\Exceptions\SlackInviteFailException::class);
        $mock = $this->getFailMock();
        $inviter = new Inviter($mock);

        $inviter->invite('test@test.com');
    }

    private function getFailMock()
    {
        $body = <<<'EOF'
{"ok":false, "error": "invaild_auth"}
EOF;

        /** @var \Mockery\MockInterface|\GuzzleHttp\Psr7\Response $responseMock */
        $responseMock = \Mockery::mock(\GuzzleHttp\Psr7\Response::class);
        $responseMock->shouldReceive('getContents')->andReturn($body);
        $responseMock->shouldReceive('getStatusCode')->andReturn(200);
        $responseMock->shouldReceive('getHeader')->andReturn(['Content-Type' => 'json']);
        $responseMock->shouldReceive('getBody')->andReturn($responseMock);

        /** @var \Mockery\MockInterface|\GuzzleHttp\Client $requestMock */
        $requestMock = \Mockery::mock(\GuzzleHttp\Client::class);
        $requestMock->shouldReceive('request')->andReturn($responseMock);

        return $requestMock;
    }
}
