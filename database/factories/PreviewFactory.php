<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Preview::class, function (Faker $faker) {
    return [
        'post_id' => factory(Post::class),
        'image_url' => $faker->imageUrl(),
    ];
});
