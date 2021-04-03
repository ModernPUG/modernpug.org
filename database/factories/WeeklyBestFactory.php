<?php

namespace Database\Factories;

use App\Models\WeeklyBest;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeeklyBestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WeeklyBest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'year' => $this->faker->year(),
            'week_no' => $this->faker->numberBetween(1, 52),
        ];
    }
}
