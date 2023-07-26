<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\ReleaseNews
 *
 * @property int $id
 * @property string $site_url 웹 사이트의 주소
 * @property string $type release type (Laravel, PHP, CI)
 * @property string $version release version
 * @property \Illuminate\Support\Carbon|null $released_at 출시일
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\ReleaseNewsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews whereReleasedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews whereSiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReleaseNews whereVersion($value)
 *
 * @mixin \Eloquent
 */
class ReleaseNews extends Model
{
    use HasFactory;

    public const SUPPORT_RELEASES = [
        'PHP' => [
            'site_url' => 'https://www.php.net/ChangeLog-7.php',
            'version' => '#layout-content > section > h3',
            'date' => '#layout-content > section > b > time',
            'post' => [
                'url' => 'https://www.php.net/ChangeLog-7.php#',
                'before' => '',
                'after' => '',
                'end' => '',
            ],
        ],
        'Laravel' => [
            'site_url' => 'https://api.github.com/repos/laravel/framework/releases',
        ],
        'Lumen' => [
            'site_url' => 'https://github.com/laravel/lumen/releases',
            'version' => '.commit-title > a',
            'date' => '.list-style-none relative-time',
            'post' => [
                'url' => 'https://github.com/laravel/lumen/releases/tag/v',
                'before' => '',
                'after' => '',
                'end' => '',
            ],
        ],
        'Codeigniter' => [
            'site_url' => 'https://www.codeigniter.com/userguide3/changelog.html',
            'version' => '#change-log > div > h2',
            'date' => '#change-log > div > p',
            'post' => [
                'url' => 'https://www.codeigniter.com/userguide3/changelog.html#version-',
                'before' => '/[. ]/',
                'after' => '-',
                'end' => '',
            ],
        ],
        'Symfony' => [
            'site_url' => 'https://symfony.com/blog/category/releases',
            'version' => '#content_wrapper > div > div.row > main > div > div > h2 > a',
            'date' => '#content_wrapper > div > div.row > main > div > div > p.metadata > span.m-r-15',
            'post' => [
                'url' => 'https://symfony.com/blog/',
                'before' => '/[. ]/',
                'after' => '-',
                'end' => '',
            ],
        ],
        'Phalcon' => [
            'site_url' => 'https://api.github.com/repos/phalcon/cphalcon/releases',
        ],
        'Slim' => [
            'site_url' => 'https://api.github.com/repos/slimphp/Slim/releases',
        ],
        /*
        'Composer' => [
            'site_url'  => 'https://api.github.com/repos/composer/composer/releases',
        ],
        'xdebug' => [
            'site_url'  => 'https://github.com/xdebug/xdebug/releases',
        ],
        */
    ];

    protected $dates = ['released_at'];
    protected $table = 'release_news';
    protected $fillable = [
        'site_url', 'type', 'version', 'released_at',
    ];

    /**
     * @return array
     */
    public static function getAllReleaseTypes()
    {
        $types = [];
        foreach (static::SUPPORT_RELEASES as $index => $type) {
            array_push($types, $index);
        }

        return $types;
    }

    /**
     * @param  string  $type  SUPPORT_RELEASES type
     * @param  string  $version  version of type
     * @return object
     */
    public static function existTypeAndVersion(string $type, string $version)
    {
        return self::where('type', $type)->where('version', $version)->first();
    }

    /**
     * @return object
     */
    public static function getReleaseNews()
    {
        return self::orderBy('released_at', 'desc')->get();
    }

    /**
     * @return ReleaseNews[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public static function getPushReleaseNews()
    {
        return self::selectRaw('type, GROUP_CONCAT(version order by released_at desc SEPARATOR \',\') as versions')
            ->selectRaw('GROUP_CONCAT(site_url order by released_at desc SEPARATOR \',\') as sites')
            ->whereDate('released_at', date('Y-m-d', strtotime('-1 days')))
            ->groupBy('type')
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getRecentlyReleaseNews()
    {
        $query = <<<'SQL'
select * from release_news where (type, released_at) in
(select type, max(released_at) from release_news group by type)
SQL;

        $query = DB::select($query);

        return self::hydrate($query);
    }

    /**
     * @param  $release
     */
    public function convertAttachment($release): SlackAttachment
    {
        $attachment = new SlackAttachment();
        $attachment->title = $release->type;

        foreach (explode(',', $release->versions) as $index => $version) {
            $attachment->action($version, explode(',', $release->sites)[$index]);
        }

        return $attachment;
    }
}
