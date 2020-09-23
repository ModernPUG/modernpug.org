<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ReleaseNews extends Notification
{
    use Queueable;

    /**
     * @var Collection|\App\Models\ReleaseNews[]
     */
    private Collection $releaseNews;

    /**
     * Create a new notification instance.
     *
     * @param  Collection|\App\Models\ReleaseNews[]  $releaseNews
     */
    public function __construct(Collection $releaseNews)
    {
        //
        $this->releaseNews = $releaseNews;
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

    public function toSlack($notifiable)
    {

        $message = new SlackMessage();
        $message->content('오늘의 릴리즈 뉴스입니다.');
        $message->to(config('release-news.slack.notification-channel'));
        $message->from('ModernPUG');
        $image = url('/img/logo/logo-slack.png');
        $message->image($image);

        foreach ($this->releaseNews as $release) {
            $attachment = $release->convertAttachment($release);
            $message->attachments[] = $attachment;
        }

        return $message;

    }
}
