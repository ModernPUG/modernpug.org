<?php

namespace Database\Factories;

use App\Models\Recruit;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecruitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recruit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $minSalary = $this->faker->numberBetween(5, 10);
        $maxSalary = $this->faker->numberBetween(1, 5);

        $salary = 500;

        return [
            'title' => $this->faker->sentence,
            'company_name' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'skills' => implode(',', $this->faker->words(random_int(1, 5))),
            'link' => $this->faker->url,
            'image_url' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'min_salary' => $minSalary * $salary,
            'max_salary' => ($minSalary + $maxSalary) * $salary,
            'expired_at' => $this->faker->dateTimeInInterval('-1 months', '+2 months'),
            'entry_user_id' => \App\Models\User::factory(),
        ];
    }
}
