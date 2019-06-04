<?php
use Faker\Factory as Faker;

$factory->define(App\Blog::class,  function () {
    $faker = Faker::create('ko_KR');
    return [
        'title' =>  $faker->title,
        'feed_url' => $faker->url,
        'site_url' => $faker->url,
    ];
});
