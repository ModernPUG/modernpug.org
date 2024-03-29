<?php

namespace Database\Factories;

use App\Models\Point;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class PointFactory extends Factory
{
    protected $model = Point::class;

    public function definition(): array
    {
        return [

            'type' => $this->faker->randomKey(Point::TYPES),
            'point' => $this->faker->numberBetween(1, 5) * 5,
            'point_type' => null,
            'point_id' => null,
            'give_user_id' => null,
            'receive_user_id' => User::factory(),
        ];
    }

    public function pointByModel(Model $model)
    {
        return $this->state(function () use ($model) {
            return [
                'point_type' => get_class($model),
                'point_id' => $model->id,
            ];
        });
    }
}
