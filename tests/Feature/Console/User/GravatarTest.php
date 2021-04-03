<?php

namespace Tests\Feature\Console\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GravatarTest extends TestCase
{
    use DatabaseTransactions;

    public function testUpdate()
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create([
            'avatar_url' => null,
        ]);

        $this->assertNull($user->avatar_url);
        $this->artisan('user:update-gravatar')
            ->assertExitCode(0);

        $user->refresh();
        $this->assertIsString($user->avatar_url);
    }
}
