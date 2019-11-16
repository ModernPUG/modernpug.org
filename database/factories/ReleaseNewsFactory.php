<?php

use Faker\Generator as Faker;

$factory->define(App\ReleaseNews::class, function (Faker $faker) {

    $randomType = $faker->randomElement(array_keys(App\ReleaseNews::SUPPORT_RELEASES));

    return [
        'site_url' => App\ReleaseNews::SUPPORT_RELEASES[$randomType]['site_url'],
        'type' => $randomType,
        'version' => $faker->randomNumber(),
        'released_at' => $faker->dateTime,
    ];
});
