<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Viewcount
 *
 * @property int $id
 * @property int $post_id
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Viewcount extends Model
{

    protected $table = 'viewcount';
    protected $fillable = ['post_id', 'ip'];

}
