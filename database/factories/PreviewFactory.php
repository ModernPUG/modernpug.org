<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Preview;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Preview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Post::factory(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
