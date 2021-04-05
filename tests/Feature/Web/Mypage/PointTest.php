<?php

namespace Tests\Feature\Web\Mypage;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PointTest extends TestCase
{
    use DatabaseTransactions;


    public function testGuestCantSeePoint()
    {

        $this->get(route('mypage.points.index'))
            ->assertRedirect();
    }

    public function testUserCantSeePoint()
    {

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('mypage.points.index'))
            ->assertRedirect();
    }


    public function testAdminCanSeePoint()
    {

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $user->assignRole(Role::all());

        $this->actingAs($user)->get(route('mypage.points.index'))
            ->assertOk();
    }
}
