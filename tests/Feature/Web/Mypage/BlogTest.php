<?php

namespace Tests\Feature\Web\Mypage;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use DatabaseTransactions;

    public function testCantSeeBlogByNonOwner()
    {
        /**
         * @var User $user
         */
        $nonOwner = User::factory()->create();

        /**
         * @var Blog $blog
         */
        $blog = Blog::factory()->create();

        $this->actingAs($nonOwner)->get(route('mypage.blogs.index'))->assertOk()->assertDontSee($blog->title);
    }

    public function testCanSeeBlogByOwner()
    {
        /**
         * @var User $user
         */
        $owner = User::factory()->create();

        /**
         * @var Blog $blog
         */
        $blog = Blog::factory()->create(['owner_id' => $owner]);

        $this->actingAs($owner)->get(route('mypage.blogs.index'))->assertOk()->assertSee($blog->title);
    }
}
