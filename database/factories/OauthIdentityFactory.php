<?php

use Faker\Factory as Faker;

$factory->define(App\OauthIdentity::class, function () {
    $faker = Faker::create('ko_KR');

    return [
        'user_id'=> factory(App\User::class),
        'provider_user_id'=> $faker->uuid,
        'provider'=> $faker->randomElement(\App\OauthIdentity::SUPPORT_PROVIDER),
        'access_token'=> $faker->uuid,
    ];
});
