<?php

namespace App\Services\ReleaseNews;

use App\ReleaseNews;
use Illuminate\Notifications\Messages\SlackMessage;

class PushReleaseNews {
    public function pushSlack() {
        $message = new SlackMessage();
        $message->content('오늘의 릴리즈 뉴스입니다.');
        $message->to(config('release-news.slack.notification-channel'));
        $message->from('ModernPUG');
        $image = url('/img/logo/logo-slack.png');
        $message->image($image);

        $count = 0;
        foreach ($this->getTargetReleaseNews() as $release) {
            $attachment = $release->convertAttachment($release);
            $message->attachments[] = $attachment;
            $count++;
        }

        if ($count !== 0) {
            \Slack::send($message);
        }
    }

    /**
     * @return object
     */
    private function getTargetReleaseNews() {
        return ReleaseNews::getPushReleaseNews();
    }
}
