<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 *
 * @method static \Database\Factories\TagFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use HasFactory;

    public const MANAGED_TAGS = [
        'PHP' => [
            'PHP',
            'php5',
            'php7',
            'composer',
            'phpunit',
            'codeception',
            'pear',
            'xdebug',
        ],
        'LARAVEL' => [
            'LARAVEL',
            'blade',
            'passport',
        ],
        'Codeigniter' => [
            'Codeigniter',
            'CI',
            'yarn',
        ],
        'Editor' => [
            'IDE',
            'PHPStorm',
            'intellij',
            'Vscode',
        ],
        'FrontEnd' => [
            'JS',
            'javascript',
            'es6',
            'es5',
            'vue',
            'vuejs',
            'vue.js',
            'angular',
            'angularjs',
            'reactjs',
            'react.js',
            'css',
            'sass',
            'scss',
            'jquery',
            'node',
            'nodejs',
            'node.js',
            'npm',
            'ie',
            'chrome',
            '크롬',
            'firefox',
            '파이어폭스',
            '익스플로러',
        ],
        'DEVOPS' => [
            'DEVOPS',
            'docker',
            'docker-compose',
            '도커',
            '쿠버네티스',
            'CI/CD',
            'ELK',
            'elasticsearch',
            'Kibana',
            'logstash',
            'apache',
            'nginx',
            'aws',
            'awx',
            'ansible',
            'Linux',
            'Ubuntu',
            'Centos',
            'lemp',
            'lamp',
            'mac',
            'macos',
            'os',
            'osx',
        ],
    ];
    protected $fillable = [
        'name',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public static function getAllManagedTags()
    {
        $return = [];
        array_map(function ($tags) use (&$return) {
            $return = array_merge($return, $tags);
        }, static::MANAGED_TAGS);

        return $return;
    }

    public static function getAllPrimaryTags()
    {
        return array_keys(static::MANAGED_TAGS);
    }
}
