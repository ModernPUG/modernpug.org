<?php

return [

    'useSlack' => env('LOG_USE_SLACK', false),

    'slack' => [
        'token' => env('LOG_SLACK_TOKEN'),
        'channel' => env('LOG_SLACK_CHANNEL'),
        'username' => env('LOG_SLACK_USERNAME', 'Log'),
        'useAttachment' => true,
        'iconEmoji' => null,
        'level' => \Monolog\Logger::ERROR,
    ],

];
