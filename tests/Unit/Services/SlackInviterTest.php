<?php

namespace Tests\Unit\Services;

use App\Exceptions\SlackInviteFailException;
use App\Services\Slack\Inviter;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class SlackInviterTest extends TestCase
{
    public function testSuccessRequest(): void
    {
        $mock = $this->getSuccessMock();
        $inviter = new Inviter($mock);

        $result = $inviter->invite('test@test.com');

        $this->assertTrue($result);

    }

    private function getSuccessMock(): Client
    {
        $body = <<<'EOF'
{"ok":true}
EOF;

        $mock = new MockHandler([
            new Response(200, [], $body),
        ]);

        return new Client(['handler' => $mock]);
    }

    public function testFailRequest(): void
    {
        $this->expectException(SlackInviteFailException::class);
        $mock = $this->getFailMock();
        $inviter = new Inviter($mock);

        $inviter->invite('test@test.com');
    }

    private function getFailMock(): Client
    {
        $body = <<<'EOF'
{"ok":false, "error": "invaild_auth"}
EOF;


        $mock = new MockHandler([
            new Response(200, [], $body),
        ]);

        return new Client(['handler' => $mock]);
    }
}
