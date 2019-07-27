<?php

namespace Tests\Feature\Console\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GravatarTest extends TestCase
{
    use DatabaseTransactions;

    public function testUpdate()
    {
        $this->artisan('user:update-gravatar')
            ->assertExitCode(0);
    }
}
