<?php

namespace Tests\Feature\Api\Slack;

use Tests\TestCase;

class SlashCommandTest extends TestCase
{
    public function testUnauthorizedException()
    {
        $this->post(config('laravel-slack-slash-command.url'))
            ->assertStatus(500);

        $this->post(config('laravel-slack-slash-command.url'), [
            'token' => '1234',
        ])
            ->assertStatus(500);

        $this->post(config('laravel-slack-slash-command.url'), [
            'token' => config('laravel-slack-slash-command.token'),
            'command'=>'/NotExistsCommand',
        ])
            ->assertStatus(500);
    }

    public function testValidRequest()
    {
        $this->post(config('laravel-slack-slash-command.url'), [
            'token' => config('laravel-slack-slash-command.token'),
            'command' => '/추첨',
        ])
            ->assertOk();
    }
}
