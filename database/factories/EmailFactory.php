<?php

namespace Database\Factories;

use App\Models\Email;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    protected $model = Email::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'is_primary' => $this->faker->boolean,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
