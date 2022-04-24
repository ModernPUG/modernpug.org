<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'link' => $this->faker->url,
            'description' => $this->faker->paragraph,
            'published_at' => $this->faker->dateTimeBetween('-1 month'),
            'blog_id' => Blog::factory(),
        ];
    }
}
