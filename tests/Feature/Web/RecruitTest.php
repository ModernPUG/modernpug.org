<?php

namespace Tests\Feature\Web;

use App\Models\Recruit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RecruitTest extends TestCase
{
    use DatabaseTransactions;

    public function testCanSeeRecruit()
    {
        $this->get(route('recruits.index'))->assertOk();

        $recruit = Recruit::factory()->create(['expired_at' => Carbon::parse('+10 days')]);

        $this->get(route('recruits.index'))
            ->assertSee($recruit->title)
            ->assertOk();
    }

    public function testCantSeeExpiredRecruit()
    {
        $this->get(route('recruits.index'))->assertOk();

        $recruit = Recruit::factory()->create(['expired_at' => Carbon::parse('-10 days')]);

        $this->get(route('recruits.index'))
            ->assertDontSee($recruit->title)
            ->assertOk();
    }

    public function testCanSee7DaysAgoClosedRecruit()
    {
        $this->get(route('recruits.index'))->assertOk();

        $recruit = Recruit::factory()->create([
            'expired_at' => Carbon::parse('+10 days'),
            'closed_at' => Carbon::parse('-7 days'),
        ]);

        $this->get(route('recruits.index'))
            ->assertSee($recruit->title)
            ->assertOk();
    }

    public function testCantSee8DaysAgoClosedRecruit()
    {
        $this->get(route('recruits.index'))->assertOk();

        $recruit = Recruit::factory()->create([
            'expired_at' => Carbon::parse('+10 days'),
            'closed_at' => Carbon::parse('-8 days'),
        ]);

        $this->get(route('recruits.index'))
            ->assertDontSee($recruit->title)
            ->assertOk();
    }

    public function testCantCreateRecruitUnauthorizedUser()
    {
        $this->get(route('recruits.create'))
            ->assertRedirect('/login');
        $this->post(route('recruits.store'))
            ->assertRedirect('/login');

        /**
         * @var User
         */
        $user = User::factory()->create(['email_verified_at' => null]);

        $this->actingAs($user)->get(route('recruits.create'))->assertRedirect('/email/verify');
        $this->actingAs($user)->post(route('recruits.store'))->assertRedirect('/email/verify');
    }

    public function testCantCreateRecruitWithEmptyRequestByAuthorizedUser()
    {
        /**
         * @var User
         */
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('recruits.create'))->assertOk();

        $this->actingAs($user)->post(route('recruits.store'), [])
            ->assertSessionHasErrors()
            ->assertRedirect(route('recruits.create'));
    }

    public function testCantCreateExpiredRecruitByAuthorizedUser()
    {
        /**
         * @var User
         */
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('recruits.create'))->assertOk();

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->make(['entry_user_id' => null]);
        $recruit->expired_at = Carbon::parse('-10 days')->format('Y-m-d');

        $this->actingAs($user)->post(route('recruits.store'), $recruit->toArray())
            ->assertSessionHasErrors()
            ->assertRedirect(route('recruits.create'));

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);
    }

    public function testCanCreateValidRecruitByAuthorizedUser()
    {
        /**
         * @var User
         */
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('recruits.create'))->assertOk();

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->make(['entry_user_id' => null]);

        $recruit->expired_at = Carbon::parse('+10 days')->format('Y-m-d');

        $this->actingAs($user)->post(route('recruits.store'), $recruit->toArray())
            ->assertToastrHasSuccess()
            ->assertRedirect(route('recruits.index'));

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);
    }

    public function testCantUpdateRecruitByNonOwner()
    {
        /**
         * @var User
         */
        $nonOwner = User::factory()->create();

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['expired_at' => Carbon::tomorrow()]);
        $recruit->expired_at = Carbon::yesterday()->format('Y-m-d');

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($nonOwner)->get(route('recruits.edit', [$recruit->id]))
            ->assertToastrHasError()
            ->assertRedirect();

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($nonOwner)->put(route('recruits.update', [$recruit->id]), $recruit->toArray())
            ->assertToastrHasError()
            ->assertRedirect();

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);
    }

    public function testUpdateRecruitByOwner()
    {
        /**
         * @var User
         */
        $owner = User::factory()->create();

        /**
         * @var Recruit $recruit
         */
        $recruit = Recruit::factory()->create(['entry_user_id' => $owner, 'expired_at' => Carbon::tomorrow()]);
        $recruit->expired_at = Carbon::yesterday()->format('Y-m-d');

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($owner)->get(route('recruits.edit', [$recruit->id]))
            ->assertOk();

        $this->actingAs($owner)->put(route('recruits.update', [$recruit->id]), $recruit->toArray())
            ->assertToastrHasSuccess()
            ->assertRedirect(route('recruits.edit', [$recruit->id]));

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);
    }

    public function testUpdateRecruitByNonOwnerWithPermission()
    {
        /**
         * @var User
         */
        $nonOwnerWithPermission = User::factory()->create();
        $nonOwnerWithPermission->givePermissionTo('recruit-edit');

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['expired_at' => Carbon::tomorrow()]);
        $recruit->expired_at = Carbon::yesterday()->format('Y-m-d');

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($nonOwnerWithPermission)->get(route('recruits.edit', [$recruit->id]))
            ->assertOk();

        $this->actingAs($nonOwnerWithPermission)->put(route('recruits.update', [$recruit->id]), $recruit->toArray())
            ->assertToastrHasSuccess()
            ->assertRedirect(route('recruits.edit', [$recruit->id]));

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);
    }

    public function testCantCloseRecruitByNonOwner()
    {
        /**
         * @var User
         */
        $nonOwner = User::factory()->create();

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['expired_at' => Carbon::tomorrow()]);

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($nonOwner)->patch(route('recruits.close', [$recruit->id]))
            ->assertToastrHasError()
            ->assertRedirect();

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);
    }

    public function testCloseRecruitByOwner()
    {
        /**
         * @var User
         */
        $owner = User::factory()->create();

        /**
         * @var Recruit $recruit
         */
        $recruit = Recruit::factory()->create(['entry_user_id' => $owner, 'expired_at' => Carbon::tomorrow()]);

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($owner)->patch(route('recruits.close', [$recruit->id]))
            ->assertToastrHasSuccess()
            ->assertRedirect();

        $this->get(route('recruits.index'))->assertOk()->assertSee('조기 마감되었습니다.');
    }

    public function testCloseRecruitByNonOwnerWithPermission()
    {
        /**
         * @var User
         */
        $nonOwnerWithPermission = User::factory()->create();
        $nonOwnerWithPermission->givePermissionTo('recruit-edit');

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['expired_at' => Carbon::tomorrow()]);

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($nonOwnerWithPermission)->patch(route('recruits.close', [$recruit->id]))
            ->assertToastrHasSuccess()
            ->assertRedirect();

        $this->get(route('recruits.index'))->assertOk()->assertSee('조기 마감되었습니다.');
    }

    public function testCantDeleteRecruitByNonOwner()
    {
        /**
         * @var User
         */
        $nonOwner = User::factory()->create();

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['expired_at' => Carbon::tomorrow()]);

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($nonOwner)->delete(route('recruits.destroy', [$recruit->id]))
            ->assertToastrHasError()
            ->assertRedirect();

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);
    }

    public function testCanDeleteRecruitByOwner()
    {
        /**
         * @var User
         */
        $owner = User::factory()->create();

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['entry_user_id' => $owner, 'expired_at' => Carbon::tomorrow()]);

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($owner)->delete(route('recruits.destroy', [$recruit->id]))
            ->assertToastrHasSuccess()
            ->assertRedirect(route('recruits.index'));

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);
    }

    public function testCanDeleteRecruitByNonOwnerWithPermission()
    {
        /**
         * @var User
         */
        $nonOwnerWithPermission = User::factory()->create();
        $nonOwnerWithPermission->givePermissionTo('recruit-delete');

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['expired_at' => Carbon::tomorrow()]);

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);

        $this->actingAs($nonOwnerWithPermission)->delete(route('recruits.destroy', [$recruit->id]))
            ->assertToastrHasSuccess()
            ->assertRedirect(route('recruits.index'));

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);
    }

    public function testCantRestoreRecruitByNonOwner()
    {
        /**
         * @var User
         */
        $nonOwner = User::factory()->create();

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['expired_at' => Carbon::tomorrow()]);
        $recruit->delete();

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);

        $this->actingAs($nonOwner)->patch(route('recruits.restore', [$recruit->id]))
            ->assertToastrHasError()
            ->assertRedirect();

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);
    }

    public function testCanRestoreRecruitByOwner()
    {
        /**
         * @var User
         */
        $owner = User::factory()->create();

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['entry_user_id' => $owner, 'expired_at' => Carbon::tomorrow()]);
        $recruit->delete();

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);

        $this->actingAs($owner)->patch(route('recruits.restore', [$recruit->id]))
            ->assertToastrHasSuccess()
            ->assertRedirect(route('recruits.index'));

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);
    }

    public function testCanRestoreRecruitByNonOwnerWithPermission()
    {
        /**
         * @var User
         */
        $nonOwnerWithPermission = User::factory()->create();
        $nonOwnerWithPermission->givePermissionTo('recruit-restore');

        /**
         * @var Recruit
         */
        $recruit = Recruit::factory()->create(['expired_at' => Carbon::tomorrow()]);
        $recruit->delete();

        $this->get(route('recruits.index'))->assertOk()->assertDontSee($recruit->title);

        $this->actingAs($nonOwnerWithPermission)->patch(route('recruits.restore', [$recruit->id]))
            ->assertToastrHasSuccess()
            ->assertRedirect(route('recruits.index'));

        $this->get(route('recruits.index'))->assertOk()->assertSee($recruit->title);
    }
}
