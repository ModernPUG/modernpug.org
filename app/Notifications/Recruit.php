<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class Recruit extends Notification
{
    use Queueable;

    /**
     * @var Collection|\App\Models\Recruit[]
     */
    private Collection $recruits;

    /**
     * Create a new notification instance.
     *
     * @param  Collection|\App\Models\Recruit[]  $recruits
     */
    public function __construct(Collection $recruits)
    {
        //
        $this->recruits = $recruits;
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
        $message->content('오늘의 신규 채용공고입니다.');
        $message->to(config('slack.recruit-channel'));
        $message->from('ModernPUG');
        $image = url('/img/logo/logo-slack.png');
        $message->image($image);

        foreach ($this->recruits as $recruit) {
            $attachment = $recruit->convertAttachment();
            $message->attachments[] = $attachment;
        }

        return $message;
    }
}
