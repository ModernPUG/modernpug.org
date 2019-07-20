<?php

use App\Post;
use Faker\Factory as Faker;

$factory->define(App\Preview::class, function () {
    $faker = Faker::create('ko_KR');

    return [
        'post_id'=>factory(Post::class),
        'image_url'=>$faker->imageUrl(),
    ];
});
