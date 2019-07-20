<?php

namespace Tests\Feature\Web\Mypage;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        \Toastr::clear();
    }

    public function testCantAccessNormalUser()
    {

        /**
         * @var User
         */
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('mypage.users.index'))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect();
    }

    public function testCanAccessPermittedUser()
    {

        /**
         * @var User
         */
        $user = factory(User::class)->create();
        $user->givePermissionTo('user-list');

        $this->actingAs($user)->get(route('mypage.users.index'))->assertOk();
    }

    public function testCantDeleteNormalUser()
    {

        /**
         * @var User
         * @var User $targetUser
         */
        $user = factory(User::class)->create();
        $targetUser = factory(User::class)->create();

        $this->actingAs($user)->delete(route('mypage.users.destroy', [$targetUser->id]))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect();
    }

    public function testCanDeletePermittedUser()
    {

        /**
         * @var User
         * @var User $targetUser
         */
        $user = factory(User::class)->create();
        $user->givePermissionTo('user-delete');
        $targetUser = factory(User::class)->create();

        $this->actingAs($user)->delete(route('mypage.users.destroy', [$targetUser->id]))
            ->assertSessionHas('toastr::notifications.0.type', 'success')
            ->assertRedirect();
    }

    public function testCantRestoreNormalUser()
    {

        /**
         * @var User
         * @var User $targetUser
         */
        $user = factory(User::class)->create();
        $targetUser = factory(User::class)->create();
        $targetUser->delete();

        $this->actingAs($user)->patch(route('mypage.users.restore', [$targetUser->id]))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect();
    }

    public function testCanRestorePermittedUser()
    {

        /**
         * @var User
         * @var User $targetUser
         */
        $user = factory(User::class)->create();
        $user->givePermissionTo('user-restore');
        $targetUser = factory(User::class)->create();
        $targetUser->delete();

        $this->actingAs($user)->patch(route('mypage.users.restore', [$targetUser->id]))
            ->assertSessionHas('toastr::notifications.0.type', 'success')
            ->assertRedirect();
    }
}
