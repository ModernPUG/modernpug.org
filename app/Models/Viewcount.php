<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\Viewcount
 *
 * @property int $id
 * @property int|null $post_id
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $view_type
 * @property int $view_id
 * @method static \Database\Factories\ViewcountFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereViewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereViewType($value)
 * @mixin \Eloquent
 */
class Viewcount extends Model
{
    use HasFactory;

    protected $table = 'viewcount';
    protected $fillable = [
        'post_id',
        'view_type',
        'view_id',
        'ip',
    ];

    public static function increase(Model $model, Request $request)
    {
        $viewCount = self::whereDate('created_at', Carbon::today())
            ->where('view_type', get_class($model))
            ->where('view_id', $model->id)
            ->where('ip', $request->ip())->get();

        if (! $viewCount->count()) {
            self::create([
                'view_type' => get_class($model),
                'view_id' => $model->id,
                'ip' => $request->ip(),
            ]);
        }
    }
}
