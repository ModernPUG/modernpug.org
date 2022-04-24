<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'feed_url' => $this->faker->unique()->url,
            'site_url' => $this->faker->unique()->url,
            'description' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl(),
            'owner_id' => User::factory(),
            'comment' => $this->faker->paragraph,
        ];
    }
}
