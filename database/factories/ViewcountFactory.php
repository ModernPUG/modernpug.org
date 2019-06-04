<?php

use App\Post;
use Faker\Factory as Faker;

$factory->define(App\Viewcount::class,  function () {
    $faker = Faker::create('ko_KR');
    return [
        'post_id' => factory(Post::class),
        'ip' => $faker->ipv4,
    ];
});
