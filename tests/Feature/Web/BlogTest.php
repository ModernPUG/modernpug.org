<?php

namespace Tests\Feature\Web;

use App\Blog;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;


    const NOT_AVAILABLE_FEED = 'http://test.com';
    const AVAILABLE_FEED = 'https://blog.jetbrains.com/feed/';

    protected function setUp()
    {
        parent::setUp();

        \Toastr::clear();
    }

    public function testIndex()
    {
        $this->get(route('blogs.index'))->assertOk();
    }

    public function testRedirectIfExecutedByUnauthorizedUserOrNotVerifiedUser()
    {
        $this->get(route('blogs.create'))
            ->assertRedirect('/email/verify');
        $this->post(route('blogs.store'))
            ->assertRedirect('/email/verify');


        /**
         * @var User $user
         */
        $user = factory(User::class)->create(['email_verified_at' => null]);

        $this->actingAs($user)->get(route('blogs.create'))->assertRedirect('/email/verify');
        $this->actingAs($user)->post(route('blogs.store'))->assertRedirect('/email/verify');


    }

    public function testCreateBlogWithEmptyRequestByAuthorizedUser()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('blogs.create'))->assertOk();

        $this->actingAs($user)->post(route('blogs.store'), [])
            ->assertSessionHasErrors('feed_url')
            ->assertRedirect(route('blogs.create'));

    }


    public function testCreateCannotAccessibleBlogByAuthorizedUser()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('blogs.create'))->assertOk();

        /**
         * @var Blog $blog
         */
        $blog = factory(Blog::class)->make(['owner_id' => null]);

        $this->actingAs($user)->post(route('blogs.store'), $blog->toArray())
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect(route('blogs.create'));

        $this->get(route('blogs.index'))->assertOk()->assertDontSee($blog->title);


    }


    public function testCreateCanAccessibleBlogByAuthorizedUser()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('blogs.create'))->assertOk();

        /**
         * @var Blog $blog
         */
        $blog = factory(Blog::class)->make(['feed_url' => self::AVAILABLE_FEED]);

        $this->actingAs($user)->post(route('blogs.store'), $blog->toArray())
            ->assertSessionHas('toastr::notifications.0.type', 'success')
            ->assertRedirect(route('blogs.create'));

    }


    public function testCannotUpdateBlogByNonOwner()
    {

        /**
         * @var User $user
         */
        $nonOwner = factory(User::class)->create();

        /**
         * @var Blog $blog
         */
        $blog = factory(Blog::class)->create();


        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

        $this->actingAs($nonOwner)->get(route('blogs.edit', [$blog->id]))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect(route('blogs.index'));

        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);


        $this->actingAs($nonOwner)->put(route('blogs.update', ['id' => $blog->id, 'feed_url' => self::NOT_AVAILABLE_FEED]))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect(route('blogs.index'));

        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);


        $this->actingAs($nonOwner)->put(route('blogs.update', [$blog->id, 'feed_url' => self::AVAILABLE_FEED]))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect(route('blogs.index'));

        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);
    }


    public function testUpdateBlogByOwner()
    {

        /**
         * @var User $user
         */
        $owner = factory(User::class)->create();

        /**
         * @var Blog $blog
         */
        $blog = factory(Blog::class)->create(['owner_id' => $owner]);

        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

        $this->actingAs($owner)->get(route('blogs.edit', [$blog->id]))
            ->assertOk();

        $this->actingAs($owner)->put(route('blogs.update', ['id' => $blog->id, 'feed_url' => self::NOT_AVAILABLE_FEED]))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect(route('blogs.edit', [$blog->id]));


        \Toastr::clear();

        $this->actingAs($owner)->put(route('blogs.update', [$blog->id, 'feed_url' => self::AVAILABLE_FEED]))
            ->assertSessionHas('toastr::notifications.0.type', 'success')
            ->assertRedirect(route('blogs.edit', ['id' => $blog->id]));

    }

    public function testCannotDeleteBlogByNonOwner()
    {

        /**
         * @var User $user
         */
        $nonOwner = factory(User::class)->create();

        /**
         * @var Blog $blog
         */
        $blog = factory(Blog::class)->create();


        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

        $this->actingAs($nonOwner)->delete(route('blogs.destroy', [$blog->id]))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect(route('blogs.index'));

        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

    }

    public function testCanDeleteBlogByOwner()
    {

        /**
         * @var User $user
         */
        $owner = factory(User::class)->create();

        /**
         * @var Blog $blog
         */
        $blog = factory(Blog::class)->create(['owner_id' => $owner]);


        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

        $this->actingAs($owner)->delete(route('blogs.destroy', [$blog->id]))
            ->assertSessionHas('toastr::notifications.0.type', 'success')
            ->assertRedirect(route('blogs.index'));

        $this->get(route('blogs.index'))->assertOk()->assertDontSee($blog->title);

    }


}
