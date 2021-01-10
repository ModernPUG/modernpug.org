<?php

namespace Tests\Feature\Api\V1\Posts;

use App\Models\Post;
use App\Models\Tag;
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
        /**
         * @var Post $yesterdayPost
         */
        $yesterdayPost = factory(Post::class)->create(['created_at' => $yesterday]);
        $yesterdayPost->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var Post $post
         */
        $post = factory(Post::class)->create();
        $post->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

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

        /**
         * @var Post $yesterdayPost
         */
        $yesterdayPost = factory(Post::class)->create(['created_at' => $yesterday]);
        $yesterdayPost->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var Post $todayPost
         */
        $todayPost = factory(Post::class)->create(['created_at' => $today]);
        $todayPost->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));


        $posts = Post::all()->toArray();


        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->getJson(route('api.v1.posts.index', [
            'created_from' => $today->format('Y-m-d'),
            'created_to' => $today->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $today->toJSON());
    }

    public function testGetAllPostsFilterYesterday()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        /**
         * @var Post $yesterdayPost
         */
        $yesterdayPost = factory(Post::class)->create(['created_at' => $yesterday]);
        $yesterdayPost->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var Post $todayPost
         */
        $todayPost = factory(Post::class)->create(['created_at' => $today]);
        $todayPost->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->getJson(route('api.v1.posts.index', [
            'created_from' => $yesterday->format('Y-m-d'),
            'created_to' => $yesterday->format('Y-m-d'),
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()
            ->assertJsonCount('1', 'data')
            ->assertJsonPath('data.0.created_at', $yesterday->toJSON());
    }

    public function testCheckFilterTags()
    {
        /**
         * @var Post $trackedTagPost
         */
        $trackedTagPost = factory(Post::class)->create();
        $trackedTagPost->tags()->sync(Tag::firstOrCreate(['name' => Tag::MANAGED_TAGS['PHP'][0]]));

        /**
         * @var Post $untrackedTagPost
         */
        $untrackedTagPost = factory(Post::class)->create();
        $untrackedTagPost->tags()->sync(Tag::firstOrCreate(['name' => 'UNTRACKED_TAG']));

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = $user->createToken('test token', ['*'])->plainTextToken;

        $response = $this->getJson(route('api.v1.posts.index', [
        ]), ['Authorization' => 'Bearer '.$token]);

        $response->assertOk()
            ->assertJsonCount('1', 'data');
    }
}
