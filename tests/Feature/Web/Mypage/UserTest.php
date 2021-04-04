<?php

namespace Tests\Feature\Web\Mypage;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;


    public function testCantAccessNormalUser()
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('mypage.users.index'))
            ->assertToastrHasError()
            ->assertRedirect();
    }

    public function testCanAccessPermittedUser()
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $user->givePermissionTo('user-list');

        $this->actingAs($user)->get(route('mypage.users.index'))->assertOk();
    }

    public function testCantDeleteNormalUser()
    {
        /**
         * @var User $user
         * @var User $targetUser
         */
        $user = User::factory()->create();
        $targetUser = User::factory()->create();

        $this->actingAs($user)->delete(route('mypage.users.destroy', [$targetUser->id]))
            ->assertToastrHasError()
            ->assertRedirect();
    }

    public function testCanDeletePermittedUser()
    {
        /**
         * @var User $user
         * @var User $targetUser
         */
        $user = User::factory()->create();
        $user->givePermissionTo('user-delete');
        $targetUser = User::factory()->create();

        $this->actingAs($user)->delete(route('mypage.users.destroy', [$targetUser->id]))
            ->assertToastrHasSuccess()
            ->assertRedirect();
    }

    public function testCantRestoreNormalUser()
    {
        /**
         * @var User $user
         * @var User $targetUser
         */
        $user = User::factory()->create();
        $targetUser = User::factory()->create();
        $targetUser->delete();

        $this->actingAs($user)->patch(route('mypage.users.restore', [$targetUser->id]))
            ->assertToastrHasError()
            ->assertRedirect();
    }

    public function testCanRestorePermittedUser()
    {
        /**
         * @var User $user
         * @var User $targetUser
         */
        $user = User::factory()->create();
        $user->givePermissionTo('user-restore');
        $targetUser = User::factory()->create();
        $targetUser->delete();

        $this->actingAs($user)->patch(route('mypage.users.restore', [$targetUser->id]))
            ->assertToastrHasSuccess()
            ->assertRedirect();
    }

    public function testCantAccessModifyUserPageByNotPermittedUser()
    {
        /**
         * @var User $user
         * @var User $targetUser
         */
        $user = User::factory()->create();
        $targetUser = User::factory()->create();

        $this->actingAs($user)->get(route('mypage.users.edit', [$targetUser->id]))
            ->assertToastrHasError()
            ->assertRedirect();
    }

    public function testCanAccessModifyUserPageByPermittedUser()
    {
        /**
         * @var User $user
         * @var User $targetUser
         */
        $user = User::factory()->create();
        $user->givePermissionTo('user-edit');
        $targetUser = User::factory()->create();

        $this->actingAs($user)->get(route('mypage.users.edit', [$targetUser->id]))
            ->assertOk();
    }

    public function testCantUpdateUserByNotPermittedUser()
    {
        /**
         * @var User $user
         * @var User $targetUser
         */
        $user = User::factory()->create();
        $targetUser = User::factory()->create();

        $this->actingAs($user)->put(route('mypage.users.update', [$targetUser->id]))
            ->assertToastrHasError()
            ->assertRedirect();
    }

    public function testCanUpdateUserByPermittedUser()
    {
        /**
         * @var User $user
         * @var User $targetUser
         */
        $user = User::factory()->create();
        $user->givePermissionTo('user-edit');
        $targetUser = User::factory()->create();

        $this->actingAs($user)->put(route('mypage.users.update', [$targetUser->id]), $targetUser->toArray())
            ->assertToastrHasSuccess()
            ->assertRedirect();
    }
}
