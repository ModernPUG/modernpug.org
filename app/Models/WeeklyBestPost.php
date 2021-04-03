<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WeeklyBestPost
 *
 * @property int $id
 * @property int $weekly_best_id
 * @property int $post_id
 * @property int $point 선정 당시 부여된 포인트
 * @property int $rank 선정 순위
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBestPost whereWeeklyBestId($value)
 * @mixin \Eloquent
 */
class WeeklyBestPost extends Model
{
    use HasFactory;
}
