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
        $weeklyBest = WeeklyBestPost::factory()->create();

        $response = $this->get(route('posts.weekly', [$weeklyBest]));

        $response->assertOk();

    }
}
