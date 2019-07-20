<?php

namespace Tests\Feature\Web\Mypage;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

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
         * @var User $user
         */
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('mypage.users.index'))
            ->assertSessionHas('toastr::notifications.0.type', 'error')
            ->assertRedirect();
    }


    public function testCanAccessPermittedUser()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();
        $user->givePermissionTo('user-list');

        $this->actingAs($user)->get(route('mypage.users.index'))->assertOk();
    }


    public function testCantDeleteNormalUser()
    {


        /**
         * @var User $user
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
         * @var User $user
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
         * @var User $user
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
         * @var User $user
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
