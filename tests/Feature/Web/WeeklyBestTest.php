<?php

namespace Tests\Feature\Web;

use App\Models\WeeklyBestPost;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WeeklyBestTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetLatestWeeklyBest()
    {
        WeeklyBestPost::factory()->create();

        $response = $this->get(route('posts.weekly'));

        $response->assertOk();
    }

    public function testGetWeeklyBest()
    {
        $weeklyBestPost = WeeklyBestPost::factory()->create();

        $response = $this->get(route('posts.weekly', [$weeklyBestPost->weekly_best]));

        $response->assertOk();
    }
}
