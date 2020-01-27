<?php

namespace Tests\Feature\Api\V1;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\MakePassportClient;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    use MakePassportClient;

    public function testGenerateAccessToken()
    {
        $this->makePassportPersonalClient();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $this->get('oauth/personal-access-tokens')
            ->assertOk()->assertJson([]);

        $user->createToken('testToken');
        $response = $this->actingAs($user)->get('oauth/personal-access-tokens');
        $response->assertOk()->assertJson(
            [
                [
                    'name' => 'testToken',
                ],
            ]
        );
    }
}
