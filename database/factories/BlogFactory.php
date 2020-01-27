<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'feed_url' => $faker->url,
        'site_url' => $faker->url,
        'description' => $faker->paragraph,
        'image_url' => $faker->url,
        'owner_id' => factory(\App\User::class),
        'comment' => $faker->paragraph,
    ];
});
