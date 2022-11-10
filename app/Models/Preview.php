<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Preview
 *
 * @property int $id
 * @property int $post_id
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Post $post
 * @method static \Database\Factories\PreviewFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Preview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Preview query()
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Preview extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'image_url'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
