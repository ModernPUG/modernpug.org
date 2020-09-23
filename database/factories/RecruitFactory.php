<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Recruit::class, function (Faker $faker) {
    $minSalary = $faker->numberBetween(5, 10);
    $maxSalary = $faker->numberBetween(1, 5);

    $salary = 500;

    return [
        'title' => $faker->sentence,
        'company_name' => $faker->company,
        'description' => $faker->paragraph,
        'skills' => implode(',', $faker->words(random_int(1, 5))),
        'link' => $faker->url,
        'image_url' => $faker->imageUrl(),
        'address' => $faker->address,
        'min_salary' => $minSalary * $salary,
        'max_salary' => ($minSalary + $maxSalary) * $salary,
        'expired_at' => $faker->dateTimeInInterval('-1 months', '+2 months'),
        'entry_user_id' => factory(\App\Models\User::class),
    ];
});
