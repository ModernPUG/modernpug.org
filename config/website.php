<?php
/**
 * Created by PhpStorm.
 * User: kkame
 * Date: 18. 7. 21
 * Time: 오후 6:51
 */

return [

    'tag_manager' => env('TAG_MANAGER', ''),
    'title' => 'Modern PHP User Group',

    'title_prefix' => 'ModernPUG::',

    'title_postfix' => '',

    'meta' => [

        'description' => '현대적인 PHP 개발에 관심 많은 개발자를 위한 개발자들의 비영리 사용자 모임입니다.',
        'keywords' => 'PHP, ModernPHP, PHP User Group, Codeigniter 라라벨 laravel',
        'author' => 'laravel@laravel.kr',

        'og' => [
            'site_name' => 'Modern PHP User Group',
            'description' => '현대적인 PHP 개발에 관심 많은 개발자를 위한 개발자들의 비영리 사용자 모임입니다.',
            'url' => '',
            'type' => 'website',
            'image' => 'https://modernpug.org/img/img-logo.png',
        ],
    ],

];