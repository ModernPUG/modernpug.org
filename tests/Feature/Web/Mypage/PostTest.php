<?php

namespace Tests\Feature\Web\Mypage;

use App\Blog;
use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function testCantSeePostByNonOwner()
    {

        /**
         * @var User
         */
        $nonOwner = factory(User::class)->create();

        /**
         * @var Post
         */
        $post = factory(Post::class)->create();

        $this->actingAs($nonOwner)->get(route('mypage.posts.index'))->assertOk()->assertDontSee($post->title);
    }

    public function testCanSeePostByOwner()
    {

        /**
         * @var User
         */
        $owner = factory(User::class)->create();

        /**
         * @var Blog
         */
        $blog = factory(Blog::class)->create(['owner_id' => $owner]);

        /**
         * @var Post
         */
        $post = factory(Post::class)->create(['blog_id' => $blog]);

        $this->actingAs($owner)->get(route('mypage.posts.index'))->assertOk()->assertSee($post->title);
    }
}
