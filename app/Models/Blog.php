<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Blog
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
 * @property \Illuminate\Support\Carbon|null $last_crawling_failed_at
 * @property int $ignore_crawling
 * @property-read \App\Models\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @method static Builder|Blog crawledBlog()
 * @method static \Database\Factories\BlogFactory factory(...$parameters)
 * @method static Builder|Blog newModelQuery()
 * @method static Builder|Blog newQuery()
 * @method static \Illuminate\Database\Query\Builder|Blog onlyTrashed()
 * @method static Builder|Blog query()
 * @method static Builder|Blog whereComment($value)
 * @method static Builder|Blog whereCrawledAt($value)
 * @method static Builder|Blog whereCrawlingFailCount($value)
 * @method static Builder|Blog whereCreatedAt($value)
 * @method static Builder|Blog whereDeletedAt($value)
 * @method static Builder|Blog whereDescription($value)
 * @method static Builder|Blog whereFeedUrl($value)
 * @method static Builder|Blog whereId($value)
 * @method static Builder|Blog whereIgnoreCrawling($value)
 * @method static Builder|Blog whereImageUrl($value)
 * @method static Builder|Blog whereLastCrawlingFailedAt($value)
 * @method static Builder|Blog whereOwnerId($value)
 * @method static Builder|Blog whereSiteUrl($value)
 * @method static Builder|Blog whereTitle($value)
 * @method static Builder|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Blog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Blog withoutTrashed()
 * @mixin \Eloquent
 */
class Blog extends Model
{
    use HasFactory;
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
