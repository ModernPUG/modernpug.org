<?php

namespace Tests\Feature\Api\Auth;


use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ScopeTest extends TestCase
{

    use DatabaseTransactions;



    public function testGetPassportScopes()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $response = $this->get(route('passport.scopes.index'));

        $response->assertOk();

    }


    public function testNotLoggedUserCantAccessPassportScopes()
    {

        $response = $this->get(route('passport.scopes.index'));

        $response->assertRedirect();

    }

}
