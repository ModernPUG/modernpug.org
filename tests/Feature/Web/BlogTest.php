<?php

namespace Tests\Feature\Web;

use App\Blog;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;


    public function testIndex()
    {
        $this->get(route('blogs.index'))->assertOk();
    }

    public function testRedirectIfExecutedByUnauthorizedUserOrNotVerifiedUser()
    {
        $this->get(route('blogs.create'))->assertStatus(302)->assertRedirect('/email/verify');
        $this->post(route('blogs.store'))->assertStatus(302)->assertRedirect('/email/verify');


        /**
         * @var User $user
         */
        $user = factory(User::class)->create(['email_verified_at' => null]);

        $this->actingAs($user)->get(route('blogs.create'))->assertStatus(302)->assertRedirect('/email/verify');
        $this->actingAs($user)->post(route('blogs.store'))->assertStatus(302)->assertRedirect('/email/verify');


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
        $blog = factory(Blog::class)->make();

        $this->actingAs($user)->post(route('blogs.store'), $blog->toArray())
            ->assertStatus(302)
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
        $blog = factory(Blog::class)->make(['feed_url' => 'https://blog.jetbrains.com/feed/']);

        $this->actingAs($user)->post(route('blogs.store'), $blog->toArray())
            ->assertStatus(302)
            ->assertSessionHas('toastr::notifications.0.type', 'success')
            ->assertRedirect(route('blogs.create'));

        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

    }


    public function testCannotDeleteBlogByNotOwnedUser()
    {

        /**
         * @var User $user
         */
        $notOwnedUser = factory(User::class)->create();

        /**
         * @var Blog $blog
         */
        $blog = factory(Blog::class)->create();


        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

        $this->actingAs($notOwnedUser)->delete(route('blogs.destroy', [$blog->id]))->assertStatus(403);

        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

    }

    public function testCanDeleteBlogByOwnedUser()
    {

        /**
         * @var User $user
         */
        $owner = factory(User::class)->create();

        /**
         * @var Blog $blog
         */
        $blog = factory(Blog::class)->create(['entry_user_id' => $owner]);


        $this->get(route('blogs.index'))->assertOk()->assertSee($blog->title);

        $this->actingAs($owner)->delete(route('blogs.destroy', [$blog->id]))->assertStatus(302);

        $this->get(route('blogs.index'))->assertOk()->assertDontSee($blog->title);

    }


}
