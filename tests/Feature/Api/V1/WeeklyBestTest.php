<?php

namespace Tests\Feature\Api\V1;

use App\User;
use App\WeeklyBestPost;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WeeklyBestTest extends TestCase
{
    use DatabaseTransactions;

    public function testCantGetWeeklyBestInformationWithoutAuthorization()
    {
        $response = $this->get(route('api.v1.posts.weekly-best'));

        $response->assertRedirect();
    }

    public function testGetAllWeeklyBestInformationWithAuthorization()
    {
        factory(WeeklyBestPost::class)->create();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->accessToken;

        $response = $this->get(route('api.v1.posts.weekly-best'), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJsonStructure(
            [
                'data' => [
                    '*' => [
                        'id',
                        'year',
                        'week_no',
                        'posts',
                    ],
                ],
            ]
        );
    }

}
