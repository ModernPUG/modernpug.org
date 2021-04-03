<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\Viewcount.
 *
 * @property int                             $id
 * @property int                             $post_id
 * @property string                          $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Viewcount extends Model
{
    use HasFactory;

    protected $table = 'viewcount';
    protected $fillable = ['post_id', 'ip'];

    public static function increase(Post $post, Request $request)
    {
        $viewCount = self::whereDate('created_at', Carbon::today())
            ->where('post_id', $post->id)->where('ip', $request->ip())->get();

        if (!$viewCount->count()) {
            self::create(['post_id' => $post->id, 'ip' => $request->ip()]);
        }
    }
}
