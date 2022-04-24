<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    protected $model = Banner::class;

    public function definition(): array
    {
        if ($this->faker->boolean) {
            $approvedAt = $this->faker->dateTimeBetween('-1 month', '+1 week');
            $approveUser = User::factory();
        } else {
            $approvedAt = null;
            $approveUser = null;
        }

        return [
            'title' => $this->faker->sentence,
            'url' => $this->faker->url,
            'position' => $this->faker->randomKey(Banner::POSITIONS),
            'priority' => $this->faker->numberBetween(1, 10),
            'create_user_id' => User::factory(),
            'approve_user_id' => $approveUser,
            'approved_at' => $approvedAt,
            'started_at' => $this->faker->dateTimeBetween('-1 month', '+1 week')->format('Y-m-d'),
            'closed_at' => $this->faker->dateTimeBetween('-1 week', '+1 month')->format('Y-m-d'),
            'deleted_at' => null,
        ];
    }

    public function allow(User $user): BannerFactory
    {
        return $this->state(function () use ($user) {
            return [
                'approve_user_id' => $user->id,
                'approved_at' => now(),
            ];
        });
    }

    public function disallow(): BannerFactory
    {
        return $this->state(function () {
            return [
                'approve_user_id' => null,
                'approved_at' => null,
            ];
        });
    }
}
