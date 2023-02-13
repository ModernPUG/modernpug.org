<?php

namespace App\Console\Commands\Discord;

use App\Models\DiscordThread;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;

class UpdateThreadCommand extends Command
{
    protected $signature = 'discord:update-thread';

    protected $description = '디스코드 질문 채널의 쓰레드를 가져옵니다';

    public function handle(Client $client): int
    {
        $this->updateActiveThread($client);
        $this->updateArchivedThread($client);

        return 0;
    }

    private function updateActiveThread(Client $client): void
    {
        $json = $client->get('https://discord.com/api/guilds/'.config('discord.guild_id').'/threads/active', [
            RequestOptions::HEADERS => [
                'Content-Type' => 'Application/json',
                'Authorization' => 'Bot '.config('discord.bot_token'),
            ],
        ])->getBody()->getContents();

        foreach (json_decode($json)->threads as $thread) {
            if ($thread->parent_id != config('discord.thread_channel_id')) {
                continue;
            }
            $discordThread = DiscordThread::updateOrCreate([
                'thread_id' => $thread->id,
            ], [
                'guild_id' => $thread->guild_id,
                'parent_id' => $thread->parent_id,
                'owner_id' => $thread->owner_id,
                'message_count' => $thread->message_count,
                'type' => $thread->type,
                'name' => $thread->name,
                'member_count' => $thread->member_count,
                'archived' => $thread->thread_metadata->archived,
                'thread_started_at' => $thread->thread_metadata->create_timestamp,
            ]);

            $discordThread->tags()->sync($thread->applied_tags);
        }
    }

    private function updateArchivedThread(Client $client): void
    {
        $json = $client->get('https://discord.com/api/channels/'.config('discord.thread_channel_id').'/threads/archived/public',
            [
                RequestOptions::HEADERS => [
                    'Content-Type' => 'Application/json',
                    'Authorization' => 'Bot '.config('discord.bot_token'),
                ],
            ])->getBody()->getContents();

        foreach (json_decode($json)->threads as $thread) {
            $discordThread = DiscordThread::updateOrCreate([
                'thread_id' => $thread->id,
            ], [
                'guild_id' => $thread->guild_id,
                'parent_id' => $thread->parent_id,
                'owner_id' => $thread->owner_id,
                'message_count' => $thread->message_count,
                'type' => $thread->type,
                'name' => $thread->name,
                'member_count' => $thread->member_count,
                'archived' => $thread->thread_metadata->archived,
                'thread_started_at' => $thread->thread_metadata->create_timestamp,
            ]);

            $discordThread->tags()->sync($thread->applied_tags);
        }
    }
}
