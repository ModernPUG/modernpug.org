<?php

namespace Tests\Feature\Web\Mypage;

use App\Blog;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp()
    {
        parent::setUp();

        \Toastr::clear();
    }

    public function testCantSeeBlogByNonOwner()
    {

        /**
         * @var User
         */
        $nonOwner = factory(User::class)->create();

        /**
         * @var Blog
         */
        $blog = factory(Blog::class)->create();

        $this->actingAs($nonOwner)->get(route('mypage.blogs.index'))->assertOk()->assertDontSee($blog->title);
    }

    public function testCanSeeBlogByOwner()
    {

        /**
         * @var User
         */
        $owner = factory(User::class)->create();

        /**
         * @var Blog
         */
        $blog = factory(Blog::class)->create(['owner_id' => $owner]);

        $this->actingAs($owner)->get(route('mypage.blogs.index'))->assertOk()->assertSee($blog->title);
    }
}
