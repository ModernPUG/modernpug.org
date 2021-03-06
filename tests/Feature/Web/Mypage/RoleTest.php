<?php

namespace Tests\Feature\Web\Mypage;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    public function testNotAuthorizedUserRedirectToLogin()
    {
        $this->get(route('mypage.roles.index'))
            ->assertRedirect('/login');
    }

    public function testEmailNotVerifiedUserRedirectToEmailVerify()
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create(['email_verified_at' => null]);

        $this->actingAs($user)->get(route('mypage.roles.index'))
            ->assertRedirect('/email/verify');
    }

    public function testCantAccessNotPermittedUser()
    {
        /**
         * @var User $owner
         */
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('mypage.roles.index'))
            ->assertToastrHasError()
            ->assertRedirect();
    }

    public function testCanAccessPermittedUser()
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $user->givePermissionTo('role-list');

        $this->actingAs($user)->get(route('mypage.roles.index'))
            ->assertOk();
    }
}
