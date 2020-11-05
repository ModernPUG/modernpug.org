<?php

namespace Tests\Feature\Api\V1\Posts;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use DatabaseTransactions;

    public function testCantGetPostsWithoutAuthorization()
    {
        $response = $this->getJson(route('api.v1.posts.index'));

        $response->assertUnauthorized();
    }

    public function testGetAllPostsWithAuthorization()
    {
        $yesterday = Carbon::yesterday();
        factory(Post::class)->create(['created_at' => $yesterday]);
        factory(Post::class)->create();

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->accessToken;

        $response = $this->getJson(route('api.v1.posts.index', [
            'created_at' => $yesterday->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'link',
                    'origin_link',
                    'description',
                    'blog_id',
                    'published_at',
                    'created_at',
                    'updated_at',
                ],
            ],
        ])
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $yesterday->toJSON());
    }

    public function testGetAllPostsFilterToday()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        factory(Post::class)->create(['created_at' => $yesterday]);
        factory(Post::class)->create(['created_at' => $today]);

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->accessToken;

        $response = $this->getJson(route('api.v1.posts.index', [
            'created_from' => $today->format('Y-m-d'),
            'created_to' => $today->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'link',
                    'origin_link',
                    'description',
                    'blog_id',
                    'published_at',
                    'created_at',
                    'updated_at',
                ],
            ],
        ])
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $today->toJSON());
    }

    public function testGetAllPostsFilterYesterday()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        factory(Post::class)->create(['created_at' => $yesterday]);
        factory(Post::class)->create(['created_at' => $today]);

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->accessToken;

        $response = $this->getJson(route('api.v1.posts.index', [
            'created_from' => $yesterday->format('Y-m-d'),
            'created_to' => $yesterday->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'link',
                    'origin_link',
                    'description',
                    'blog_id',
                    'published_at',
                    'created_at',
                    'updated_at',
                ],
            ],
        ])
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $yesterday->toJSON());
    }
}
