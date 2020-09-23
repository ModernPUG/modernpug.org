<?php

namespace Tests\Feature\Web;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(route('posts.index'))->assertOk();
    }

    public function testSearch()
    {
        $this->get(route('posts.search'))->assertOk();
    }

    public function testIfSeePostIncreaseViewCountAndRedirectOriginLink()
    {

        /**
         * @var Post $post
         */
        $post = factory(Post::class)->create();

        $this->assertCount(0, $post->viewcount);

        $this->get(route('posts.show', [$post->id]))
            ->assertRedirect($post->link);

        $post->refresh();
        $this->assertCount(1, $post->viewcount);
    }
}
