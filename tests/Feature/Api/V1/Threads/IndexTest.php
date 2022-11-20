<?php

namespace Tests\Feature\Api\V1\Threads;

use App\Models\DiscordThread;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use DatabaseTransactions;

    public function testCantGetThreadsWithoutAuthorization()
    {
        $response = $this->getJson(route('api.v1.threads.index'));

        $response->assertUnauthorized();
    }

    public function testGetAllThreadsWithAuthorization()
    {
        $yesterday = Carbon::yesterday();
        /**
         * @var DiscordThread $yesterdayThread
         */
        $yesterdayThread = DiscordThread::factory()->create(['created_at' => $yesterday]);

        /**
         * @var DiscordThread $thread
         */
        $thread = DiscordThread::factory()->create();

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->getJson(route('api.v1.threads.index', [
            'created_at' => $yesterday->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'member_count',
                    'message_count',
                    'url',
                    'created_at',
                ],
            ],
        ])
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $yesterday->toJSON());
    }

    public function testGetAllThreadsFilterToday()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();

        /**
         * @var DiscordThread $yesterdayThread
         */
        $yesterdayThread = DiscordThread::factory()->create(['created_at' => $yesterday]);
        $yesterdayThread->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var DiscordThread $todayThread
         */
        $todayThread = DiscordThread::factory()->create(['created_at' => $today]);
        $todayThread->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        $threads = DiscordThread::all()->toArray();

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->getJson(route('api.v1.threads.index', [
            'created_from' => $today->format('Y-m-d'),
            'created_to' => $today->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $today->toJSON());
    }

    public function testGetAllThreadsFilterYesterday()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        /**
         * @var DiscordThread $yesterdayThread
         */
        $yesterdayThread = DiscordThread::factory()->create(['created_at' => $yesterday]);
        $yesterdayThread->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var DiscordThread $todayThread
         */
        $todayThread = DiscordThread::factory()->create(['created_at' => $today]);
        $todayThread->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->getJson(route('api.v1.threads.index', [
            'created_from' => $yesterday->format('Y-m-d'),
            'created_to' => $yesterday->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $yesterday->toJSON());
    }

}
