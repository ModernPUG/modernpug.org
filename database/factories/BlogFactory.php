<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'feed_url' => $faker->unique()->url,
        'site_url' => $faker->unique()->url,
        'description' => $faker->paragraph,
        'image_url' => $faker->url,
        'owner_id' => factory(\App\Models\User::class),
        'comment' => $faker->paragraph,
    ];
});
