<?php

use Faker\Factory as Faker;

$factory->define(App\Tag::class, function () {
    $faker = Faker::create('ko_KR');

    return [
        'name'=>$faker->word,
    ];
});
