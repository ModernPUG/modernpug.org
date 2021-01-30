<?php

namespace App\Services\Blog;

use App\Models\Post;
use App\Models\Tag;
use App\Notifications\DailyNewPosts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class PushDailyNewPosts
{

    public function pushSlack()
    {
        $newPosts = $this->getTargetPosts();
        if (! $newPosts->count()) {
            return;
        }


        Notification::route('slack', config('laravel-slack.slack_webhook_url'))
            ->notify(new DailyNewPosts($newPosts));
    }

    /**
     * @return Post[]|Collection
     */
    private function getTargetPosts()
    {
        return Post::getDailyNewPosts(Tag::getAllManagedTags());
    }
}
