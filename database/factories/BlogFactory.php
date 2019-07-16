<?php

use Faker\Factory as Faker;

$factory->define(App\Blog::class, function () {
    $faker = Faker::create('ko_KR');
    return [
        'title' => $faker->paragraph,
        'feed_url' => $faker->url,
        'site_url' => $faker->url,
        'description' => $faker->paragraph,
        'image_url' => $faker->url,
        'owner_id' => factory(\App\User::class),
        'comment' => $faker->paragraph,
    ];
});
