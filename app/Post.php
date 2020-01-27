<?php

namespace App;

use App\Services\Blog\StripPosts;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Messages\SlackAttachment;

/**
 * App\Post
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string $description
 * @property int $blog_id
 * @property \Illuminate\Support\Carbon $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Blog $blog
 * @property-read Preview $preview
 * @property-read \Illuminate\Database\Eloquent\Collection|Tag[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|Viewcount[] $viewcount
 * @method static bool|null forceDelete()
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|Post onlyTrashed()
 * @method static Builder|Post query()
 * @method static bool|null restore()
 * @method static Builder|Post whereBlogId($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDeletedAt($value)
 * @method static Builder|Post whereDescription($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereLink($value)
 * @method static Builder|Post wherePublishedAt($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Post withoutTrashed()
 * @mixin \Eloquent
 */
class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['published_at', 'deleted_at'];
    protected $fillable = [
        'title',
        'link',
        'description',
        'published_at',
        'blog_id',
    ];

    public static function getLatestPosts(int $count, array $tagNames = [])
    {
        $posts = self::with('blog', 'preview', 'tags');

        if (count($tagNames)) {
            $posts->whereHas('tags', function (Builder $builder) use ($tagNames) {
                $builder->whereIn('tags.name', $tagNames);
            });
        }

        return $posts->orderBy('published_at', 'desc')->limit($count)->get();
    }

    public static function getLastBestPosts(int $lastDays = 30, int $limit = 20, array $tagNames = [])
    {
        $posts = self::with('blog', 'preview', 'tags');

        $posts->selectRaw('posts.*');
        $posts->selectRaw('count(posts.id) AS vcount');
        $posts->selectRaw('(COUNT(posts.id)/abs(datediff(published_at,now()))) as rank_point');
        $posts->leftJoin('viewcount', 'posts.id', 'viewcount.post_id');

        if (count($tagNames)) {
            $posts->whereHas('tags', function (Builder $builder) use ($tagNames) {
                $builder->whereIn('tags.name', $tagNames);
            });
        }

        $posts->where('published_at', '>=', Carbon::parse('- '.$lastDays.' days')->format('Y-m-d H:i:s'));

        $posts->groupBy('posts.id');

        return $posts->orderBy('rank_point', 'desc')->limit($limit)->get();
    }

    public function getPublishedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('y-m-d');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class)->withTrashed();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function preview()
    {
        return $this->hasOne(Preview::class)->withDefault(['image_url' => url('/img/adult-article-assortment-1496183.jpg')]);
    }

    public function viewcount()
    {
        return $this->hasMany(Viewcount::class);
    }

    /**
     * @param int $rank
     * @return SlackAttachment
     */
    public function convertAttachment(int $rank): SlackAttachment
    {
        $url = route('posts.show', [$this->id]);
        $title = "$rank. {$this->title}";

        $attachment = new SlackAttachment();
        $attachment->authorName = $this->blog->title;
        $attachment->authorLink = $this->blog->site_url;
        $attachment->authorIcon = $this->blog->image_url;
        $attachment->title = $title;
        $attachment->url = $url;
        $attachment->content = StripPosts::slack($this->description);
        $attachment->timestamp = strtotime($this->getAttributes()['published_at']);

        foreach ($this->tags as $tag) {
            $attachment->action($tag->name, route('posts.search', [$tag->name]));
        }

        return $attachment;
    }
}
