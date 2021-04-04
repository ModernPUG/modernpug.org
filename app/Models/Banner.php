<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * App\Models\Banner
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $position
 * @property int $priority
 * @property string $started_at
 * @property string $closed_at
 * @property int $create_user_id
 * @property int|null $approve_user_id
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $approve_user
 * @property-read \App\Models\User $create_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $images
 * @property-read int|null $images_count
 * @method static \Database\Factories\BannerFactory factory(...$parameters)
 * @method static Builder|Banner newModelQuery()
 * @method static Builder|Banner newQuery()
 * @method static \Illuminate\Database\Query\Builder|Banner onlyTrashed()
 * @method static Builder|Banner query()
 * @method static Builder|Banner whereApproveUserId($value)
 * @method static Builder|Banner whereApprovedAt($value)
 * @method static Builder|Banner whereClosedAt($value)
 * @method static Builder|Banner whereCreateUserId($value)
 * @method static Builder|Banner whereCreatedAt($value)
 * @method static Builder|Banner whereDeletedAt($value)
 * @method static Builder|Banner whereId($value)
 * @method static Builder|Banner wherePosition($value)
 * @method static Builder|Banner wherePriority($value)
 * @method static Builder|Banner whereStartedAt($value)
 * @method static Builder|Banner whereTitle($value)
 * @method static Builder|Banner whereUpdatedAt($value)
 * @method static Builder|Banner whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Banner withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Banner withoutTrashed()
 * @mixin \Eloquent
 */
class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const POSITIONS = [
        self::POSITION_LNB => 'LNB 날개배너',
    ];
    public const POSITION_LNB = 'lnb';

    protected $dates = ['approved_at'];

    protected $fillable = [
        'title',
        'url',
        'position',
        'priority',
        'started_at',
        'closed_at',
    ];


    public function create_user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approve_user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(File::class, 'upload');
    }

    public static function getActiveBanners(string $position = null): Collection
    {
        return self::when($position, function (Builder $builder) use ($position) {
            return $builder->where('position', '=', $position);
        })
            ->whereNotNull('approved_at')
            ->where('started_at', '<=', now())
            ->where('closed_at', '>=', now())
            ->get();
    }
}
