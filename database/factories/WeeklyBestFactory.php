<?php

namespace Database\Factories;

use App\Models\WeeklyBest;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeeklyBestFactory extends Factory
{
    protected $model = WeeklyBest::class;

    public function definition(): array
    {
        return [
            'year' => $this->faker->year(),
            'week_no' => $this->faker->numberBetween(1, 52),
        ];
    }
}
