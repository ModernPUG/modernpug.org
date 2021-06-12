<?php

namespace Database\Factories;

use App\Models\Viewcount;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewcountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Viewcount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip' => $this->faker->ipv4,
        ];
    }
}
