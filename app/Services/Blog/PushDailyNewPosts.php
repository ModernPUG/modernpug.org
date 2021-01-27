<?php

namespace App\Services\Blog;

use App\Models\Post;
use App\Models\Tag;
use App\Notifications\DailyNewPosts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class PushDailyNewPosts
{
    public const LAST_DAYS = 7;
    public const LIMIT = 10;

    public function pushSlack()
    {
        Notification::route('slack', config('laravel-slack.slack_webhook_url'))
            ->notify(new DailyNewPosts($this->getTargetPosts()));
    }

    /**
     * @return Post[]|Collection
     */
    private function getTargetPosts()
    {
        return Post::getDailyNewPosts(Tag::getAllManagedTags());
    }
}
