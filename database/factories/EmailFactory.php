<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Email::class, function (Faker $faker) {

    return [
        'user_id' => factory(User::class),
        'is_primary' => $faker->boolean,
        'email' => $faker->unique()->safeEmail,
    ];
});
