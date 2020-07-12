<?php

namespace Tests\Feature\Api\V1;

use App\Recruit;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RecruitTest extends TestCase
{
    use DatabaseTransactions;

    public function testCantGetRecruitInformationWithoutAuthorization()
    {
        $response = $this->get(route('api.v1.recruits.index'));

        $response->assertRedirect();
    }

    public function testGetAllRecruitInformationWithAuthorization()
    {
        $recruits = factory(Recruit::class, 5)->create();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->accessToken;

        $response = $this->get(route('api.v1.recruits.index'),
            ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJson(
            [
                'data' => $recruits->map(
                    function (Recruit $recruit) {
                        return $recruit->only(['id', 'title']);
                    }
                )->toArray(),
            ]
        );
    }

    public function testGetRecruitInformationWithAuthorization()
    {
        /**
         * @var Recruit $recruit
         */
        $recruit = factory(Recruit::class)->create();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->accessToken;

        $response = $this->get(route('api.v1.recruits.show', ['recruit' => $recruit->id]),
            ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJson(
            [
                'data' => $recruit->only('id', 'title'),
            ]
        );
    }
}
