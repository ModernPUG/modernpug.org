<?php

namespace Database\Factories;

use App\Models\Recruit;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecruitFactory extends Factory
{
    protected $model = Recruit::class;

    public function definition(): array
    {
        $minSalary = $this->faker->numberBetween(5, 10);
        $maxSalary = $this->faker->numberBetween(1, 5);

        $salary = 500;

        return [
            'title' => $this->faker->sentence,
            'company_name' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'skills' => implode(',', $this->faker->randomElements(Tag::getAllManagedTags(), random_int(1, 5))),
            'link' => $this->faker->url,
            'image_url' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'min_salary' => $minSalary * $salary,
            'max_salary' => ($minSalary + $maxSalary) * $salary,
            'expired_at' => $this->faker->dateTimeInInterval('-1 months', '+2 months'),
            'entry_user_id' => User::factory(),
        ];
    }

    public function close(): RecruitFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'closed_at' => now(),
                'closed_user_id' => User::factory(),
            ];
        });
    }
}
