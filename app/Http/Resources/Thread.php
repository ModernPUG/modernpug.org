<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Thread
 *
 * @mixin \App\Models\DiscordThread
 */
class Thread extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'member_count' => $this->member_count,
            'message_count' => $this->message_count,
            'url' => $this->toUrl(),
            'created_at' => $this->created_at,
        ];
    }
}
