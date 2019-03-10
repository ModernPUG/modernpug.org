<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\SlackAttachment;

/**
 * App\ReleaseNews
 *
 * @property int $id
 * @property string $site_url 웹 사이트의 주소
 * @property string $type release type (Laravel, PHP, CI)
 * @property string $version release version
 * @property \Illuminate\Support\Carbon $released_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews whereReleasedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews whereSiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews whereVersion($value)
 * @mixin \Eloquent
 */
class ReleaseNews extends Model
{
    const SUPPORT_RELEASES = [
        'PHP' => [
            'site_url'  => 'http://php.net/releases/',
            'version'   => '#layout-content > h2',
            'date'      => '#layout-content > ul > li:nth-child(1)',
            'post'      => [
                'url'       => 'http://php.net/releases/#',
                'before'    => '',
                'after'     => '',
                'end'       => ''
            ]
        ],
         'Laravel' => [
             'site_url'  => 'https://api.github.com/repos/laravel/laravel/releases',
         ],
        'Lumen' => [
            'site_url'  => 'https://github.com/laravel/lumen/releases',
            'version'   => '.commit-title > a',
            'date'      => '.list-style-none relative-time',
            'post'      => [
                'url'       => 'https://github.com/laravel/lumen/releases/tag/v',
                'before'    => '',
                'after'     => '',
                'end'       => ''
            ],
        ],
         'Codeigniter' => [
             'site_url'  => 'https://www.codeigniter.com/userguide3/changelog.html',
             'version'   => '#change-log > div > h2',
             'date'      => '#change-log > div > p',
             'post'     => [
                 'url'      => 'https://www.codeigniter.com/userguide3/changelog.html#version-',
                 'before'   => '/[. ]/',
                 'after'    => '-',
                 'end'      => ''
             ]
         ],
         'Symfony' => [
             'site_url'  => 'https://symfony.com/blog/category/releases',
             'version'   => '#content_wrapper > div > div.row > main > div > div > h2 > a',
             'date'      => '#content_wrapper > div > div.row > main > div > div > p.metadata > span.m-r-15',
             'post'   =>  [
                 'url'       => 'https://symfony.com/blog/',
                 'before'    => '/[. ]/',
                 'after'     => '-',
                 'end'      => ''
             ]
         ],
        'Phalcon' => [
            'site_url'  => 'https://api.github.com/repos/phalcon/cphalcon/releases',
        ],
        'Slim' => [
            'site_url'  => 'https://api.github.com/repos/slimphp/Slim/releases',
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
        'site_url', 'type', 'version', 'released_at'
    ];

    /**
     * @return array
     */
    static public function getAllReleaseTypes() {
        $types = [];
        foreach (static::SUPPORT_RELEASES as $index => $type) {
            array_push($types, $index);
        }
        return $types;
    }

    /**
     * @param  string $type    SUPPORT_RELEASES type
     * @param  string $version version of type
     * @return object
     */
    static public function existTypeAndVersion(string $type, string $version) {
        return self::where('type', $type)->where('version', $version)->first();
    }

    /**
     * @return object
     */
    static public function getReleaseNews() {
        return self::orderBy('released_at', 'desc')->get();
    }

    /**
     * @return ReleaseNews[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    static public function getPushReleaseNews() {
        return self::selectRaw('type, GROUP_CONCAT(version order by released_at desc SEPARATOR \',\') as versions')
            ->selectRaw('GROUP_CONCAT(site_url order by released_at desc SEPARATOR \',\') as sites')
            ->whereDate('created_at', date('Y-m-d', strtotime('-1 days')))
            ->groupBy('type')
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    static public function getRecentlyReleaseNews() {
        $query = <<<SQL
select * from release_news where (type, released_at) in
(select type, max(released_at) from release_news group by type)
SQL;

        $query = DB::select($query);
        return self::hydrate($query);
    }

    /**
     * @param $release
     * @return SlackAttachment
     */
    public function convertAttachment($release): SlackAttachment {
        $attachment = new SlackAttachment();
        $attachment->title = $release->type;

        foreach (explode(',', $release->versions) as $index => $version) {
            $attachment->action($version, explode(',', $release->sites)[$index]);
        }

        return $attachment;
    }

}
