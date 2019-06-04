<?php

use App\User;
use Faker\Factory as Faker;

$factory->define(App\Email::class,  function () {
    $faker = Faker::create('ko_KR');
    return [
        'user_id'=>factory(User::class),
        'is_primary'=>$faker->boolean,
        'email'=>$faker->unique()->safeEmail,
    ];
});
