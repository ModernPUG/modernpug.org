<?php

namespace Tests\Feature\Api\V1;

use App\Recruit;
use App\User;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Tests\MakePassportClient;
use Tests\TestCase;

class RecruitTest extends TestCase
{
    use DatabaseTransactions;
    use MakePassportClient;

    public function testCantGetRecruitInformationWithoutAuthorization()
    {
        $response = $this->get(route('api.v1.recruits.index'));

        $response->assertRedirect();
    }

    public function testGetAllRecruitInformationWithAuthorization()
    {
        $this->makePassportPersonalClient();

        $recruits = factory(Recruit::class, 5)->create();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $response = $this->get(route('api.v1.recruits.index'));

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
        $this->makePassportPersonalClient();

        /**
         * @var Recruit $recruit
         */
        $recruit = factory(Recruit::class)->create();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        $response = $this->get(route('api.v1.recruits.show', ['recruit' => $recruit->id]));

        $response->assertOk()->assertJson(
            [
                'data' => $recruit->only('id', 'title'),
            ]
        );
    }
}
