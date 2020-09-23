<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\OauthIdentity::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\Models\User::class),
        'provider_user_id' => $faker->uuid,
        'provider' => $faker->randomElement(\App\Models\OauthIdentity::SUPPORT_PROVIDER),
        'access_token' => $faker->uuid,
    ];
});
