<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WeeklyBest.
 *
 * @property int                                                         $id
 * @property string                                                      $year
 * @property int                                                         $week_no
 * @property \Illuminate\Support\Carbon|null                             $created_at
 * @property \Illuminate\Support\Carbon|null                             $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property int|null                                                    $posts_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBest query()
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBest whereWeekNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeeklyBest whereYear($value)
 * @mixin \Eloquent
 */
class WeeklyBest extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'week_no'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'weekly_best_posts', 'weekly_best_id', 'post_id');
    }
}
