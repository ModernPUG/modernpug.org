<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DiscordTag
 *
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordTag whereName($value)
 *
 * @mixin \Eloquent
 */
class DiscordTag extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
    ];
}
