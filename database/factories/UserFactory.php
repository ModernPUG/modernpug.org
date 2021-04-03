<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'github_url' => $this->faker->url,
            'facebook_url' => $this->faker->url,
            'twitter_url' => $this->faker->url,
            'homepage_url' => $this->faker->url,
            'avatar_url' => $this->faker->imageUrl(),
            'comment' => $this->faker->paragraph,
            'remember_token' => Str::random(10),
        ];
    }
}
