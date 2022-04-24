<?php

namespace Database\Factories;

use App\Models\ReleaseNews;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReleaseNewsFactory extends Factory
{
    protected $model = ReleaseNews::class;

    public function definition(): array
    {
        $randomType = $this->faker->randomKey(ReleaseNews::SUPPORT_RELEASES);

        return [
            'site_url' => ReleaseNews::SUPPORT_RELEASES[$randomType]['site_url'],
            'type' => $randomType,
            'version' => $this->faker->randomNumber(),
            'released_at' => $this->faker->dateTimeBetween('-1 month'),
        ];
    }
}
