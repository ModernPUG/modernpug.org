<?php
/**
 * Created by PhpStorm.
 * User: kkame
 * Date: 18. 12. 8
 * Time: 오후 4:34.
 */

return [
    'url' => env('SLACK_URL', ''),
    'token' => env('SLACK_INVITE_TOKEN', ''),
    'invite-channels'=>env('SLACK_INVITE_CHANNELS', '#general'),
    'recruit-channel'=>env('SLACK_RECRUIT_CHANNEL', '#general'),
    'post-channel'=>env('SLACK_POST_CHANNEL', '#general'),
];
