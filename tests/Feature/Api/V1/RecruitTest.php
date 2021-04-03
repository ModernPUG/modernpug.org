<?php

namespace Tests\Feature\Api\V1;

use App\Models\Recruit;
use App\Models\User;
use Carbon\Carbon;
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
        $notExpiredCount = 5;
        $expiredCount = 1;

        Recruit::factory()->count($notExpiredCount)->create(['expired_at' => now()->addDays(10)]);
        Recruit::factory()->count($expiredCount)->create(['expired_at' => now()->days(-1)]);

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->get(route('api.v1.recruits.index'),
            ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJsonCount($notExpiredCount, 'data')->assertJsonStructure(
            [
                'data' => [
                    '*' => ['id', 'title'],
                ],
            ],
        );
    }

    public function testGetAllRecruitsFilterToday()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();

        /**
         * @var Recruit $yesterdayRecruit
         */
        $yesterdayRecruit = Recruit::factory()->create(['created_at' => $yesterday, 'expired_at' => $today]);

        /**
         * @var Recruit $todayRecruit
         */
        $todayRecruit = Recruit::factory()->create(['created_at' => $today, 'expired_at' => $today]);

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->getJson(route('api.v1.recruits.index', [
            'created_from' => $today->format('Y-m-d'),
            'created_to' => $today->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $today->toJSON());
    }

    public function testGetAllRecruitsFilterYesterday()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        /**
         * @var Recruit $yesterdayRecruit
         */
        $yesterdayRecruit = Recruit::factory()->create(['created_at' => $yesterday, 'expired_at' => $today]);

        /**
         * @var Recruit $todayRecruit
         */
        $todayRecruit = Recruit::factory()->create(['created_at' => $today, 'expired_at' => $today]);

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->getJson(route('api.v1.recruits.index', [
            'created_from' => $yesterday->format('Y-m-d'),
            'created_to' => $yesterday->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $yesterday->toJSON());
    }

    public function testGetRecruitInformationWithAuthorization()
    {
        /**
         * @var Recruit $recruit
         */
        $recruit = Recruit::factory()->create();

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->get(route('api.v1.recruits.show', ['recruit' => $recruit->id]),
            ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJson(
            [
                'data' => $recruit->only('id', 'title'),
            ]
        );
    }
}
