<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReleaseNews
 *
 * @property int $id
 * @property string $site_url 웹 사이트의 주소
 * @property string $type release type (Laravel, PHP, CI)
 * @property string $version release version
 * @property string $content release 내용
 * @property string|null $released_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReleaseNews whereContent($value)
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
            'site_url'  => 'http://php.net/ChangeLog-7.php',
            'version'   => '#layout-content > section > h3',
            'content'   => '#layout-content > section > ul',
            'date'      => '#layout-content > section > b > time'
        ],
        'Laravel' => [
            'site_url'  => 'https://github.com/laravel/laravel/releases',
            'version'   => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div:nth-child(1) > div > div.d-none.d-md-block.flex-wrap.flex-items-center.col-12.col-md-3.col-lg-2.px-md-3.pb-1.pb-md-4.pt-md-4.float-left.text-md-right.v-align-top > ul > li:nth-child(1) > a > span', // fixed laravel release version child(3)
            'content'   => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div:nth-child(1) > div > div.col-12.col-md-9.col-lg-10.px-md-3.py-md-4.release-main-section.commit.open.float-left > div.markdown-body',
            'date'      => 'body > div.application-main > div > div > div.container-lg.new-discussion-timeline.experiment-repo-nav.p-responsive > div.repository-content > div.position-relative.border-top.clearfix > div:nth-child(1) > div > div.col-12.col-md-9.col-lg-10.px-md-3.py-md-4.release-main-section.commit.open.float-left > div.release-header > p > relative-time'
        ],
        'Codeigniter' => [
            'site_url'  => 'https://www.codeigniter.com/userguide3/changelog.html',
            'version'   => '#change-log > div > h2',
            'content'   => '#change-log > div',
            'date'      => '#change-log > div > p'
        ],
        'Symfony' => [
            'site_url'  => 'https://symfony.com/blog/category/releases',
            'version'   => '#content_wrapper > div > div.row > main > div > div > h2 > a',
            'content'   => '#content_wrapper > div > div.row > main > section > .post__content',
            'date'      => '#content_wrapper > div > div.row > main > div > div > p.metadata > span',
            'post'   =>  [ // if 2depth release content
                'url'       => 'https://symfony.com/blog/',
                'before'    => '/[. ]/',
                'after'     => '-',
            ]
        ]
    ];

    protected $table = 'release_news';

    protected $fillable = [
        'site_url', 'type', 'version', 'content', 'released_at'
    ];

    /**
     * @return array
     */
    static public function mergeAllReleaseTypes() {
        $types = [];
        array_push($types, 'All');
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
     * @param  int $limit show release news max 7 versions
     * @return object
     */
    static public function getReleaseNews(int $limit = 7) {
        return self::orderBy('released_at', 'desc')->limit($limit)->get();
    }
}
