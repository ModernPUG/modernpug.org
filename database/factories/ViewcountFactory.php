<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Viewcount::class, function (Faker $faker) {
    return [
        'post_id' => factory(Post::class),
        'ip' => $faker->ipv4,
    ];
});
