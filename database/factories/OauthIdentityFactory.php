<?php

namespace Database\Factories;

use App\Models\OauthIdentity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OauthIdentityFactory extends Factory
{
    protected $model = OauthIdentity::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'provider_user_id' => $this->faker->uuid,
            'provider' => $this->faker->randomElement(OauthIdentity::SUPPORT_PROVIDER),
            'access_token' => $this->faker->uuid,
        ];
    }
}
