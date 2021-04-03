<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\WeeklyBest;
use App\Models\WeeklyBestPost;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeeklyBestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (app()->environment('local')) {


            for ($i = 0; $i < 5; $i++) {

                $time = Carbon::parse('-'.$i.'week');

                /**
                 * @var WeeklyBest $weeklyBest
                 */
                $weeklyBest = WeeklyBest::factory()->create(['year' => $time->year, 'week_no' => $time->weekOfYear]);

                Post::whereBetween('published_at', [
                    $time->startOfWeek()->startOfDay()->toDateTimeString(),
                    $time->endOfWeek()->endofDay()->toDateTimeString(),
                ])
                    ->limit(10)
                    ->get()
                    ->each(function (Post $post) use ($weeklyBest) {
                        WeeklyBestPost::factory()->create([
                            'weekly_best_id' => $weeklyBest,
                            'post_id' => $post,
                        ]);
                    });
            }
        }
    }
}
