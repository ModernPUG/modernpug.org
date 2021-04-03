<?php

namespace Database\Factories;

use App\Models\ReleaseNews;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReleaseNewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReleaseNews::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomType = $this->faker->randomKey(\App\Models\ReleaseNews::SUPPORT_RELEASES);

        return [
            'site_url' => \App\Models\ReleaseNews::SUPPORT_RELEASES[$randomType]['site_url'],
            'type' => $randomType,
            'version' => $this->faker->randomNumber(),
            'released_at' => $this->faker->dateTime,
        ];
    }
}
