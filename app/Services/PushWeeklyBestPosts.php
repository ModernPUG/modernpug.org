<?php


namespace App\Services;

use App\Post;
use App\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\SlackMessage;


class PushWeeklyBestPosts
{

    const LAST_DAYS = 7;
    const LIMIT = 10;

    public function pushSlack()
    {

        $message = new SlackMessage();
        $message->content("Modern PUG 주간 인기글입니다");
        $message->from('ModernPUG');
        $image = url('/img/logo/logo-slack.png');
        $message->image($image);


        $rank = 1;

        foreach ($this->getTargetPosts() as $post) {

            $attachment = $post->convertAttachment($rank);

            $message->attachments[] = $attachment;
            $rank++;
        }


        \Slack::send($message);

    }

    /**
     * @return Post[]|Collection
     */
    private function getTargetPosts()
    {
        return Post::getLastBestPosts(self::LAST_DAYS, self::LIMIT, Tag::getAllManagedTags());
    }

}