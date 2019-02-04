<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    const CRAWLING_DATAS = [
        'PHP' => [
            'site_url'  => 'http://php.net/ChangeLog-7.php',
            'version'   => '#layout-content > section > h3',
            'content'   => '#layout-content > section > ul'
        ],
        'Laravel' => [
            'site_url'  => 'https://laravel.com/docs/master/releases',
            'version'   => '.docs-wrapper.container > article > ul > li:nth-child(3) > a', // fixed laravel release version child(3)
            'content'   => '.docs-wrapper.container > article'
        ],
        'Codeigniter' => [
            'site_url'  => 'https://www.codeigniter.com/userguide3/changelog.html',
            'version'   => '#change-log > div > h2',
            'content'   => '#change-log > div'
        ],
        'Symfony' => [
            'site_url'  => 'https://symfony.com/blog/category/releases',
            'version'   => '#content_wrapper > div > div.row > main > div > div > h2 > a',
            'content'   => '#content_wrapper > div > div.row > main > section > .post__content',
            'post'   =>  [ // if 2depth release content
                'url'       => 'https://symfony.com/blog/',
                'before'    => '/[. ]/',
                'after'     => '-',
            ]
        ]
    ];

    protected $fillable = [
        'site_url', 'type', 'version', 'content'
    ];

    static public function getAllCrawlData() {
        return static::CRAWLING_DATAS;
    }

    static public function existTypeAndVersion(string $type, string $version) {
        return self::where('type', $type)->where('version', $version)->first();
    }
}
