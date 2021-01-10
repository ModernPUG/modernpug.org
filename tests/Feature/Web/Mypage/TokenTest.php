<?php

namespace Tests\Feature\Web\Mypage;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TokenTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateTokenWithNonAuthorizedUser()
    {
        $this->post(route('mypage.tokens.store', ['name' => 'test token']))
            ->assertRedirect('/login');
    }

    public function testCreateTokenWithAuthorizedUser()
    {
        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $this->actingAs($user)->post(route('mypage.tokens.store', ['name' => 'test token']))
            ->assertCreated();

        $this->assertCount(1, $user->tokens);
    }

    public function testDeleteTokenWithAuthorizedUser()
    {
        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token')->accessToken;
        $this->actingAs($user)->delete(route('mypage.tokens.delete', ['id' => $token->id]))
            ->assertNoContent();

        $this->assertCount(0, $user->tokens);
    }

    public function testDeleteTokenWithNotOwnedUser()
    {
        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token')->accessToken;

        $notOwnedUser = factory(User::class)->create();

        $this->actingAs($notOwnedUser)->delete(route('mypage.tokens.delete', ['id' => $token->id]))
            ->assertNotFound();
    }
}
