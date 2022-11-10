<?php

namespace App\Console\Commands\Discord;

use App\Models\DiscordTag;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;

class UpdateChannelTagCommand extends Command
{
    protected $signature = 'discord:update-channel-tag';

    protected $description = '디스코드 질문하기 채널의 태그정보를 갱신해옵니다';

    public function handle(Client $client): int
    {
        $json = $client->get('https://discord.com/api/channels/'.config('discord.thread_channel_id'), [
            RequestOptions::HEADERS => [
                'Content-Type' => 'Application/json',
                'Authorization' => 'Bot '.config('discord.bot_token'),
            ],
        ])->getBody()->getContents();

        foreach (json_decode($json)->available_tags as $tag) {
            DiscordTag::updateOrCreate([
                'id' => $tag->id,
            ], [
                'name' => $tag->name,
            ]);
        }
        return 0;
    }
}
