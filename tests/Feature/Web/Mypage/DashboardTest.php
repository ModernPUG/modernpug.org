<?php

namespace Tests\Feature\Web\Mypage;

use App\Blog;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    public function testNotAuthorizedUserRedirectToLogin()
    {
        $this->get(route('mypage.dashboard.index'))
            ->assertRedirect('/login');
    }

    public function testEmailNotVerifiedUserRedirectToEmailVerify()
    {

        /**
         * @var User
         */
        $user = factory(User::class)->create(['email_verified_at' => null]);

        $this->actingAs($user)->get(route('mypage.dashboard.index'))
            ->assertRedirect('/email/verify');
    }

    public function testUserCanOnlySeeOwnedBlog()
    {

        /**
         * @var User
         * @var Blog $ownedBlog
         * @var Blog $nonOwnedBlog
         */
        $owner = factory(User::class)->create();
        $ownedBlog = factory(Blog::class)->create(['owner_id' => $owner->id]);
        $nonOwnedBlog = factory(Blog::class)->create();

        $this->actingAs($owner)->get(route('mypage.dashboard.index'))
            ->assertSee($ownedBlog->title)
            ->assertDontSee($nonOwnedBlog->title)
            ->assertOk();
    }
}
