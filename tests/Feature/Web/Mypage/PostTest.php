<?php

namespace Tests\Feature\Web\Mypage;

use App\Models\Blog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function testCantSeePostByNonOwner()
    {
        /**
         * @var User
         */
        $nonOwner = User::factory()->create();

        /**
         * @var Post
         */
        $post = Post::factory()->create();

        $this->actingAs($nonOwner)->get(route('mypage.posts.index'))->assertOk()->assertDontSee($post->title);
    }

    public function testCanSeePostByOwner()
    {
        /**
         * @var User
         */
        $owner = User::factory()->create();

        /**
         * @var Blog
         */
        $blog = Blog::factory()->create(['owner_id' => $owner]);

        /**
         * @var Post
         */
        $post = Post::factory()->create(['blog_id' => $blog]);

        $this->actingAs($owner)->get(route('mypage.posts.index'))->assertOk()->assertSee($post->title);
    }
}
