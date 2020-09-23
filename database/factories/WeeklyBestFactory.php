<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\WeeklyBest;
use Faker\Generator as Faker;

$factory->define(WeeklyBest::class, function (Faker $faker) {
    return [
        'year' => $faker->year(),
        'week_no' => $faker->numberBetween(1, 52),
    ];
});
