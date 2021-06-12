<?php

namespace Tests\Feature\Web\Mypage;

use App\Models\Banner;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BannerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCanSeeAllowedActiveBanner()
    {
        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->allow(User::factory()->create())->create([
            'started_at' => now()->addDays(-10),
            'closed_at' => now()->addDays(+10),
        ]);

        $this->get(route('home'))
            ->assertSee($banner->title)
            ->assertSee($banner->url);
    }

    public function testDontSeeAllowedInactiveBanner()
    {
        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->allow(User::factory()->create())->create([
            'started_at' => now()->addDays(-10),
            'closed_at' => now()->addDays(-5),
        ]);

        $this->get(route('home'))
            ->assertDontSee($banner->title)
            ->assertDontSee($banner->url);
    }

    public function testDontSeeDisallowedBanner()
    {
        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->disallow()->create();

        $this->get(route('home'))
            ->assertDontSee($banner->title)
            ->assertDontSee($banner->url);
    }

    public function testGuestCantSeeBanners()
    {
        $this->get(route('mypage.banners.index'))
            ->assertRedirect();
    }

    public function testAuthorizedUserCanSeeOwnedBanners()
    {

        /**
         * @var User $otherUser
         */
        $otherUser = User::factory()->create();
        /**
         * @var Banner $otherUserBanner
         */
        $otherUserBanner = Banner::factory()->create(['title' => 'NOT_OWNED_BANNER', 'url' => 'http://not-owned.test']);
        $otherUserBanner->create_user()->associate($otherUser)->save();

        /**
         * @var User $owner
         */
        $owner = User::factory()->create();
        /**
         * @var Banner $ownedBanner
         */
        $ownedBanner = Banner::factory()->create(['title' => 'OWNED_BANNER', 'url' => 'http://owned.test']);
        $ownedBanner->create_user()->associate($owner)->save();

        $this->actingAs($owner)->get(route('mypage.banners.index'))
            ->assertOk()
            ->assertSee($ownedBanner->title)
            ->assertSee($ownedBanner->url)
            ->assertDontSee($otherUserBanner->title)
            ->assertDontSee($otherUserBanner->url);
    }

    public function testAdminUserCanSeeAllBanners()
    {

        /**
         * @var User $otherUser
         */
        $otherUser = User::factory()->create();
        /**
         * @var Banner $otherUserBanner
         */
        $otherUserBanner = Banner::factory()->create(['title' => 'NOT_OWNED_BANNER', 'url' => 'http://not-owned.test']);
        $otherUserBanner->create_user()->associate($otherUser)->save();

        /**
         * @var User $admin
         */
        $admin = User::factory()->create();
        $admin->assignRole(Role::all());

        $this->actingAs($admin)->get(route('mypage.banners.index'))
            ->assertOk()
            ->assertSee($otherUserBanner->title)
            ->assertSee($otherUserBanner->url);
    }

    public function testGuestCantCreateBanner()
    {
        $this->get(route('mypage.banners.create'))
            ->assertRedirect();

        $banner = Banner::factory()->make();

        $this->post(route('mypage.banners.store'), $banner->toArray())
            ->assertRedirect();
    }

    public function testAuthorizedUserCanCreateBanner()
    {
        Storage::fake('public');

        /**
         * @var User $user
         */
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('mypage.banners.create'))
            ->assertOk();

        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->make();

        $this->actingAs($user)
            ->post(route('mypage.banners.store'), array_merge($banner->toArray(), [
                'image' => UploadedFile::fake()->image('banner.jpg'),
            ]))
            ->assertRedirect();

        /**
         * @var Banner $savedBanner
         */
        $savedBanner = Banner::where('title', $banner->title)->where('url', $banner->url)->firstOrFail();
        Storage::disk('public')->assertExists('banners/'.$savedBanner->images()->latest()->first()->id);
    }

    public function testGuestCantModifyBanner()
    {
        $banner = Banner::factory()->create();

        $this->get(route('mypage.banners.edit', [$banner]))
            ->assertRedirect();

        $this->put(route('mypage.banners.update', [$banner]), $banner->toArray())
            ->assertRedirect();
    }

    public function testNotOwnedUserCantModifyBanner()
    {
        $banner = Banner::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('mypage.banners.edit', [$banner]))
            ->assertRedirect();

        $this->actingAs($user)->put(route('mypage.banners.update', [$banner]), $banner->toArray())
            ->assertRedirect();
    }

    public function testOwnerCanModifyBanner()
    {
        Storage::fake('public');

        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->create();

        $this->actingAs($banner->create_user)->get(route('mypage.banners.edit', [$banner]))
            ->assertOk();

        $this->actingAs($banner->create_user)
            ->put(route('mypage.banners.update', [$banner]), array_merge($banner->toArray(), [
                'image' => UploadedFile::fake()->image('banner.jpg'),
            ]))
            ->assertRedirect();

        $banner->refresh();

        Storage::disk('public')->assertExists('banners/'.$banner->images()->latest()->first()->id);
    }

    public function testNotOwnedUserCantDeleteBanner()
    {
        $banner = Banner::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->delete(route('mypage.banners.destroy', [$banner]))
            ->assertRedirect();
    }

    public function testOwnerCanDeleteBanner()
    {

        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->create();

        $this->actingAs($banner->create_user)->delete(route('mypage.banners.destroy', [$banner]))
            ->assertRedirect();

        $banner->refresh();

        $this->assertNotNull($banner->deleted_at);
    }

    public function testNonAdminCantAllowBanner()
    {

        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->disallow()->create();

        $this->actingAs($banner->create_user)->post(route('mypage.banners.approve', [$banner]))
            ->assertRedirect();

        $banner->refresh();

        $this->assertNull($banner->approve_user);
        $this->assertNull($banner->approved_at);
    }

    public function testAdminCanAllowBanner()
    {

        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->disallow()->create();

        /**
         * @var User $admin
         */
        $admin = User::factory()->create();
        $admin->assignRole(Role::all());

        $this->actingAs($admin)->post(route('mypage.banners.approve', [$banner]))
            ->assertOk()
            ->assertJsonStructure([
                'result',
            ]);

        $banner->refresh();

        $this->assertTrue($admin->is($banner->approve_user));
        $this->assertNotNull($banner->approved_at);
    }

    public function testNonAdminCantDisallowBanner()
    {

        /**
         * @var User $admin
         */
        $admin = User::factory()->create();
        $admin->assignRole(Role::all());

        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->allow($admin)->create();

        $this->actingAs($banner->create_user)->delete(route('mypage.banners.disapprove', [$banner]))
            ->assertRedirect();

        $banner->refresh();

        $this->assertNotNull($banner->approve_user);
        $this->assertNotNull($banner->approved_at);
    }

    public function testAdminCanDisallowBanner()
    {

        /**
         * @var User $admin
         */
        $admin = User::factory()->create();
        $admin->assignRole(Role::all());

        /**
         * @var Banner $banner
         */
        $banner = Banner::factory()->allow($admin)->create();

        $this->actingAs($admin)->delete(route('mypage.banners.disapprove', [$banner]))
            ->assertOk()
            ->assertJsonStructure([
                'result',
            ]);

        $banner->refresh();

        $this->assertNull($banner->approve_user);
        $this->assertNull($banner->approved_at);
    }
}
