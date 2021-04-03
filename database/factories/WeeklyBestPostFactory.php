<?php

namespace Database\Factories;

use App\Models\WeeklyBestPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeeklyBestPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WeeklyBestPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'weekly_best_id' => \App\Models\WeeklyBest::factory(),
            'post_id' => \App\Models\Post::factory(),
            'point' => $this->faker->randomNumber(),
            'rank' => $this->faker->numberBetween(1, 10),
        ];
    }
}
