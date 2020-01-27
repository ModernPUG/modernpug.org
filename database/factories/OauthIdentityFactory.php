<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\OauthIdentity::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'provider_user_id' => $faker->uuid,
        'provider' => $faker->randomElement(\App\OauthIdentity::SUPPORT_PROVIDER),
        'access_token' => $faker->uuid,
    ];
});
