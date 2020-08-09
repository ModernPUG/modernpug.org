<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WeeklyBest
 *
 * @property int $id
 * @property string $year
 * @property int $week_no
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBest whereWeekNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyBest whereYear($value)
 * @mixin \Eloquent
 */
class WeeklyBest extends Model
{
    protected $fillable = ['year', 'week_no'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'weekly_best_posts', 'weekly_best_id', 'post_id');
    }
}
