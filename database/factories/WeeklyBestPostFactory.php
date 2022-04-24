<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\WeeklyBest;
use App\Models\WeeklyBestPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeeklyBestPostFactory extends Factory
{
    protected $model = WeeklyBestPost::class;

    public function definition(): array
    {
        return [
            'weekly_best_id' => WeeklyBest::factory(),
            'post_id' => Post::factory(),
            'point' => $this->faker->randomNumber(),
            'rank' => $this->faker->numberBetween(1, 10),
        ];
    }
}
