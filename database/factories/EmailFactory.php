<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(\App\Models\Email::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'is_primary' => $faker->boolean,
        'email' => $faker->unique()->safeEmail,
    ];
});
