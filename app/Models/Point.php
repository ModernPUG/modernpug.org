<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Point
 *
 * @property int $id
 * @property string $type
 * @property Model|\Eloquent $point
 * @property string|null $point_type
 * @property int|null $point_id
 * @property int|null $give_user_id
 * @property int $receive_user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\User|null $give_user
 * @property-read \App\Models\User|null $receive_user
 * @method static \Database\Factories\PointFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Point newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Point newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Point query()
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereGiveUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point wherePointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point wherePointType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereReceiveUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereType($value)
 * @mixin \Eloquent
 */
class Point extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    public const TYPES = [
        self::TYPE_AD => '광고 포인트',
        self::TYPE_SKILL => '스킬 포인트',
        self::TYPE_COMMUNITY => '커뮤니티 포인트',
        self::TYPE_USED => '사용완료 포인트',
    ];

    public const TYPE_AD = 'ad';
    public const TYPE_SKILL = 'skill';
    public const TYPE_COMMUNITY = 'community';
    public const TYPE_USED = 'used';

    public function receive_user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function give_user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function point()
    {
        return $this->morphTo();
    }
}
