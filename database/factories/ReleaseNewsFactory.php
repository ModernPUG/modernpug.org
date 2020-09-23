<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\ReleaseNews::class, function (Faker $faker) {
    $randomType = $faker->randomKey(\App\Models\ReleaseNews::SUPPORT_RELEASES);

    return [
        'site_url' => \App\Models\ReleaseNews::SUPPORT_RELEASES[$randomType]['site_url'],
        'type' => $randomType,
        'version' => $faker->randomNumber(),
        'released_at' => $faker->dateTime,
    ];
});
