<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(\App\Models\Preview::class, function (Faker $faker) {
    return [
        'post_id' => factory(Post::class),
        'image_url' => $faker->imageUrl(),
    ];
});
