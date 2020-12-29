<?php

namespace App\Services\Blog;

use App\Models\Post;
use App\Models\Tag;
use App\Notifications\WeeklyBestPosts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class PushWeeklyBestPosts
{
    public const LAST_DAYS = 7;
    public const LIMIT = 10;

    public function pushSlack()
    {
        Notification::route('slack', config('laravel-slack.slack_webhook_url'))
            ->notify(new WeeklyBestPosts($this->getTargetPosts()));
    }

    /**
     * @return Post[]|Collection
     */
    private function getTargetPosts()
    {
        return Post::getLastBestPosts(self::LAST_DAYS, self::LIMIT, Tag::getAllManagedTags());
    }
}
