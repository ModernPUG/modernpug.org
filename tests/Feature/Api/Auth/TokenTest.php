<?php

namespace Tests\Feature\Api\Auth;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Tests\MakePassportClient;
use Tests\TestCase;

class TokenTest extends TestCase
{
    use DatabaseTransactions;
    use MakePassportClient;

    public function testGetTokens()
    {

        $this->makePassportPersonalClient();;

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
