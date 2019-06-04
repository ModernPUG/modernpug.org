<?php

use App\Blog;
use Faker\Factory as Faker;

$factory->define(App\Post::class,  function () {
    $faker = Faker::create('ko_KR');
    return [
        'title'=>$faker->title,
        'link'=>$faker->url,
        'description'=>$faker->paragraph,
        'published_at'=>$faker->dateTime,
        'blog_id'=>factory(Blog::class),
    ];
});
