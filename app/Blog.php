<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Blog
 *
 * @property int $id
 * @property string|null $title
 * @property string $feed_url
 * @property string|null $site_url
 * @property string|null $description
 * @property string|null $image_url
 * @property int|null $owner_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $crawled_at
 * @property int $crawling_fail_count
 * @property string|null $last_crawling_failed_at
 * @property int $ignore_crawling
 * @property-read \App\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog crawledBlog()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Blog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereCrawledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereCrawlingFailCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereFeedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereIgnoreCrawling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereLastCrawlingFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereSiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Blog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Blog withoutTrashed()
 * @mixin \Eloquent
 */
class Blog extends Model
{
    use SoftDeletes;
    public const AUTO_IGNORE_CRAWLING_FAIL_COUNT = 5;

    protected $dates = ['deleted_at', 'crawled_at', 'last_crawling_failed_at'];
    protected $fillable = [
        'title', 'feed_url', 'site_url', 'description', 'image_url', 'owner_id', 'comment',
    ];

    public function scopeCrawledBlog(Builder $query)
    {
        return $query->whereNotNull('site_url')->where('site_url', '!=', '');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
