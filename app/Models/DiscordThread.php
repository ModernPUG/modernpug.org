<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\DiscordThread
 *
 * @property int $id
 * @property int $guild_id
 * @property int $thread_id
 * @property int $parent_id
 * @property int $owner_id
 * @property int $message_count
 * @property int $type
 * @property string $name
 * @property int $member_count
 * @property int $archived
 * @property \Illuminate\Support\Carbon $thread_started_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\DiscordThreadFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereArchived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereGuildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereMemberCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereMessageCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereThreadStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordThread whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DiscordThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'guild_id',
        'thread_id',
        'parent_id',
        'owner_id',
        'message_count',
        'type',
        'name',
        'member_count',
        'archived',
        'thread_started_at',
    ];

    protected $dates = [
        'thread_started_at',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(DiscordTag::class, 'discord_thread_tags', 'tag_id', 'thread_id', 'thread_id');
    }

    public function toUrl(): string
    {
        return 'https://discord.com/channels/'.$this->guild_id.'/'.$this->thread_id;
    }
}
