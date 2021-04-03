<?php

namespace Database\Factories;

use App\Models\OauthIdentity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OauthIdentityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OauthIdentity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'provider_user_id' => $this->faker->uuid,
            'provider' => $this->faker->randomElement(\App\Models\OauthIdentity::SUPPORT_PROVIDER),
            'access_token' => $this->faker->uuid,
        ];
    }
}
