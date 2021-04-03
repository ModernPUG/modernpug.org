<?php

namespace Tests\Feature\Console\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    public function testAssignRole()
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $role = Role::firstOrFail();

        $this->assertCount(0, $user->roles);

        $this->artisan('user:assign-role')
            ->expectsQuestion('해당 유저의 이메일을 입력해주세요', $user->email)
            ->expectsQuestion('등록할 Role을 입력해주세요', $role->name)
            ->expectsQuestion("[{$user->name}]{$user->email}유저에게 [{$role->name}] role을 부여합니다. 맞습니까?", 'yes')
            ->assertExitCode(0);

        $user->refresh();
        $this->assertCount(1, $user->roles);
        $this->assertTrue($user->hasRole($role->name));
    }

    public function testRemoveRole()
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $role = Role::firstOrFail();

        $user->assignRole($role->name);

        $this->assertCount(1, $user->roles);

        $this->artisan('user:remove-role')
            ->expectsQuestion('해당 유저의 이메일을 입력해주세요', $user->email)
            ->expectsQuestion('제거할 Role을 입력해주세요', $role->name)
            ->expectsQuestion("[{$user->name}]{$user->email}유저에게 [{$role->name}] role을 제거합니다. 맞습니까?", 'yes')
            ->assertExitCode(0);

        $user->refresh();
        $this->assertCount(0, $user->roles);
        $this->assertFalse($user->hasRole($role->name));
    }
}
