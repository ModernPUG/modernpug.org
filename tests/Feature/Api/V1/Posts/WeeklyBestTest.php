<?php

namespace Tests\Feature\Api\V1\Posts;

use App\Models\User;
use App\Models\WeeklyBestPost;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WeeklyBestTest extends TestCase
{
    use DatabaseTransactions;

    public function testCantGetWeeklyBestInformationWithoutAuthorization()
    {
        $response = $this->getJson(route('api.v1.posts.weekly-best'));

        $response->assertUnauthorized();
    }

    public function testGetAllWeeklyBestInformationWithAuthorization()
    {
        factory(WeeklyBestPost::class)->create();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->accessToken;

        $response = $this->getJson(route('api.v1.posts.weekly-best'), ['Authorization' => 'Bearer '.$token]);

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
