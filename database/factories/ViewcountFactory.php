<?php

namespace Database\Factories;

use App\Models\Viewcount;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewcountFactory extends Factory
{
    protected $model = Viewcount::class;

    public function definition(): array
    {
        return [
            'ip' => $this->faker->ipv4,
        ];
    }
}
