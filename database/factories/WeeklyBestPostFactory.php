<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WeeklyBestPost;
use Faker\Generator as Faker;

$factory->define(WeeklyBestPost::class, function (Faker $faker) {
    return [

        'weekly_best_id' => factory(\App\WeeklyBest::class),
        'post_id' => factory(\App\Post::class),
        'point' => $faker->randomNumber(),
        'rank' => $faker->numberBetween(1, 10),
    ];
});
