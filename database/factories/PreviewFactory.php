<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Preview;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreviewFactory extends Factory
{
    protected $model = Preview::class;

    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
