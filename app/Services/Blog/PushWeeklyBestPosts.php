<?php

namespace App\Services\Blog;

use App\Models\Post;
use App\Models\WeeklyBest;
use App\Notifications\WeeklyBestPosts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class PushWeeklyBestPosts
{
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

        /**
         * @var WeeklyBest $weeklyBest
         */
        $weeklyBest = WeeklyBest::latest()->first();

        return $weeklyBest->posts;

    }
}
