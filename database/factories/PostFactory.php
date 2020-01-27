<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'link' => $faker->url,
        'description' => $faker->paragraph,
        'published_at' => $faker->dateTime,
        'blog_id' => factory(Blog::class),
    ];
});
