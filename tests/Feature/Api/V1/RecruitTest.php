<?php

namespace Tests\Feature\Api\V1;

use App\Recruit;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
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


        factory(Recruit::class, 5)->make();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $response = $this->get(route('api.v1.recruits.index'));

        $response->assertOk()->assertJson([
            'data' => [
                [
                    'id' => '1',
                ],
            ],
        ]);

    }

    public function testGetRecruitInformationWithAuthorization()
    {


        /**
         * @var Recruit $recruit
         */
        $recruit = factory(Recruit::class)->make();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $response = $this->get(route('api.v1.recruits.show', [$recruit->id]));

        $response->assertOk()->assertJson([
            'data' => [
            ],
        ]);

    }


}
