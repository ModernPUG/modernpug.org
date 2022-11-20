<?php

namespace Database\Factories;

use App\Models\DiscordThread;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscordThreadFactory extends Factory
{
    protected $model = DiscordThread::class;

    public function definition(): array
    {
        return [
            'guild_id' => config('discord.guild_id', 1),
            'parent_id' => config('discord.thread_channel_id', 1),
            'thread_id' => $this->faker->randomNumber(),
            'owner_id' => $this->faker->randomNumber(),
            'message_count' => $this->faker->randomNumber(),
            'type' => 11,
            'name' => $this->faker->sentences(asText: true),
            'member_count' => $this->faker->randomNumber(),
            'archived' => $this->faker->boolean(),
            'thread_started_at' => $this->faker->dateTime(),
        ];
    }

}
