<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\SlackAttachment;

/**
 * App\ReleaseNews
 *
 * @property int $id
 * @property string $site_url 웹 사이트의 주소
 * @property string $type release type (Laravel, PHP, CI)
 * @property string $version release version
 * @property string|null $released_at
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
             'site_url'  => 'https://github.com/laravel/laravel/releases',
             'version'   => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.d-none.d-md-block.flex-wrap.flex-items-center.col-12.col-md-3.col-lg-2.px-md-3.pb-1.pb-md-4.pt-md-4.float-left.text-md-right.v-align-top > ul > li > a > span', // fixed laravel release version child(3)
             'date'      => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.col-12.col-md-9.col-lg-10.px-md-3.py-md-4.release-main-section.commit.open.float-left > div.release-header > p > relative-time',
             'post'      => [
                 'url'      => 'https://github.com/laravel/laravel/releases/tag/v',
                 'before'   => '',
                 'after'    => '',
                 'end'      => ''
             ]
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
            'site_url'  => 'https://github.com/phalcon/cphalcon/releases',
            'version'   => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.d-none.d-md-block.flex-wrap.flex-items-center.col-12.col-md-3.col-lg-2.px-md-3.pb-1.pb-md-4.pt-md-4.float-left.text-md-right.v-align-top > ul > li > a > span', // fixed laravel release version child(3)
            'date'      => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.col-12.col-md-9.col-lg-10.px-md-3.py-md-4.release-main-section.commit.open.float-left > div.release-header > p > relative-time',
            'post'      => [
                'url'      => 'https://github.com/phalcon/cphalcon/releases/tag/v',
                'before'   => '',
                'after'    => '',
                'end'      => ''
            ]
        ],
        'Slim' => [
            'site_url'  => 'https://github.com/slimphp/Slim/releases',
            'version'   => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.d-none.d-md-block.flex-wrap.flex-items-center.col-12.col-md-3.col-lg-2.px-md-3.pb-1.pb-md-4.pt-md-4.float-left.text-md-right.v-align-top > ul > li > a > span', // fixed laravel release version child(3)
            'date'      => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.col-12.col-md-9.col-lg-10.px-md-3.py-md-4.release-main-section.commit.open.float-left > div.release-header > p > relative-time',
            'post'      => [
                'url'      => 'https://github.com/slimphp/Slim/releases/tag/v',
                'before'   => '',
                'after'    => '',
                'end'      => ''
            ]
        ],
        'Lumen' => [
            'site_url'  => 'https://github.com/laravel/lumen/releases',
            'version'   => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div > div > div > div.d-flex > h4 > a',
            'date'      => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div > span > relative-time',
            'post'      => [
                'url'      => 'https://github.com/laravel/lumen/releases/tag/v',
                'before'   => '',
                'after'    => '',
                'end'      => ''
            ]
        ],
        /*
        'Composer' => [
            'site_url'  => 'https://github.com/composer/composer/releases',
            'version'   => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.d-none.d-md-block.flex-wrap.flex-items-center.col-12.col-md-3.col-lg-2.px-md-3.pb-1.pb-md-4.pt-md-4.float-left.text-md-right.v-align-top > ul > li > a > span', // fixed laravel release version child(3)
            'date'      => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.col-12.col-md-9.col-lg-10.px-md-3.py-md-4.release-main-section.commit.open.float-left > div.release-header > p > relative-time',
            'post'      => [
                'url'      => 'https://github.com/composer/composer/releases/tag/v',
                'before'   => '',
                'after'    => '',
                'end'      => ''
            ]
        ],
        'xdebug' => [
            'site_url'  => 'https://github.com/xdebug/xdebug/releases',
            'version'   => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.d-none.d-md-block.flex-wrap.flex-items-center.col-12.col-md-3.col-lg-2.px-md-3.pb-1.pb-md-4.pt-md-4.float-left.text-md-right.v-align-top > ul > li > a > span', // fixed laravel release version child(3)
            'date'      => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div > div > div.col-12.col-md-9.col-lg-10.px-md-3.py-md-4.release-main-section.commit.open.float-left > div.release-header > p > relative-time',
            'post'      => [
                'url'      => 'https://github.com/xdebug/xdebug/releases/tag/v',
                'before'   => '',
                'after'    => '',
                'end'      => ''
            ]
        ],
        */
    ];

    protected $table = 'release_news';

    protected $fillable = [
        'site_url', 'type', 'version', 'released_at'
    ];

    /**
     * @return array
     */
    static public function mergeAllReleaseTypes() {
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
     * @param bool $slack
     * @return object
     */
    static public function getReleaseNews(bool $slack = false) {
        if ($slack) {
            return self::orderBy('released_at', 'desc')
                ->whereDate('created_at', date('Y-m-d', strtotime('-1 days')))
                ->get();
        }
        return self::orderBy('released_at', 'desc')->get();
    }

    /**
     * @return array
     */
    static public function getRecentlyReleaseNews() {
        $query = <<<SQL
select * from release_news where (type, released_at) in
(select type, max(released_at) from release_news group by type)
SQL;

        return \DB::select($query);
    }

    /**
     * @param $release
     * @return SlackAttachment
     */
    static public function convertAttachment($release): SlackAttachment {
        $attachment = new SlackAttachment();
        $attachment->title = $release->type;
        $attachment->url = $release->site_url;
        $attachment->content = $release->version;
//        $attachment->imageUrl = url('/img/release/' . $release->type . '.png');
        $attachment->timestamp = strtotime($release->released_at);

        return $attachment;
    }

}
