<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WeeklyBestPost
 *
 * @property int $id
 * @property int $weekly_best_id
 * @property int $post_id
 * @property int $point 선정 당시 부여된 포인트
 * @property int $rank 선정 순위
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBestPost whereWeeklyBestId($value)
 * @mixin \Eloquent
 */
class WeeklyBestPost extends Model
{
}
