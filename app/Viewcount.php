<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Viewcount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Viewcount query()
 * @mixin \Eloquent
 */
class Viewcount extends Model
{

    protected $table = 'viewcount';
    protected $fillable = ['post_id', 'ip'];

}
