<?php
/**
 * Created by PhpStorm.
 * User: kkame
 * Date: 18. 12. 8
 * Time: 오후 4:34
 */

return [
    'url' => env('SLACK_URL', ''),
    'token' => env('SLACK_TOKEN', ''),
    'channels'=>env('SLACK_CHANNELS',''),
];