<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Blog
 *
 * @property int $id
 * @property string|null $title
 * @property string $feed_url
 * @property string|null $site_url
 * @property string|null $description
 * @property string|null $image_url
 * @property int|null $entry_user_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereEntryUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereFeedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereSiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Blog extends Model
{
    protected $fillable = [
        'title', 'feed_url', 'site_url',
    ];


    static public function getCrawledBlog()
    {
        return static::whereNotNull('site_url')->where('site_url','!=','')->get();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
