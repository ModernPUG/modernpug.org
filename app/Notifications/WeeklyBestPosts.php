<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class WeeklyBestPosts extends Notification
{
    use Queueable;

    /**
     * @var Collection|Post[]
     */
    private Collection $posts;

    /**
     * Create a new notification instance.
     *
     * @param  Collection|Post[]  $posts
     */
    public function __construct(Collection $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notification)
    {
        $message = new SlackMessage();
        $message->to('#general');
        $message->content('Modern PUG 주간 인기글입니다');
        $message->from('ModernPUG');
        $image = url('/img/logo/logo-slack.png');
        $message->image($image);

        $rank = 1;

        foreach ($this->posts as $post) {
            $attachment = $post->convertAttachment($rank);

            $message->attachments[] = $attachment;
            $rank++;
        }

        return $message;
    }
}
