<?php

namespace Tests\Feature\Api\Auth;


use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TokenTest extends TestCase
{

    use DatabaseTransactions;


    public function testGetTokens()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $user->createToken('testToken');

        $response = $this->get(route('passport.tokens.index'));

        $response->assertOk();


    }

    public function testRefreshToken()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $response = $this->post(route('passport.token.refresh'));

        $response->assertOk();


    }


}
