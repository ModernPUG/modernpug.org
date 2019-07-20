<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Preview
 *
 * @property int $id
 * @property int $post_id
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Preview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Preview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Preview query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Preview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Preview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Preview whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Preview wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Preview whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Preview extends Model
{
    protected $fillable = ['post_id', 'image_url'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
