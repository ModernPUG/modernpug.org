<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\Tag;
use App\Models\WeeklyBest;
use App\Models\WeeklyBestPost;

class WeeklyBestUpdater
{
    public const LAST_DAYS = 30;
    public const LIMIT = 10;

    public function update(): bool
    {
        $weeklyBest = WeeklyBest::firstOrCreate([
            'year' => date('Y'),
            'week_no' => date('W'),
        ]);

        if ($weeklyBest->posts->count()) {
            return true;
        }

        $posts = Post::getLastBestPosts(self::LAST_DAYS, self::LIMIT, Tag::getAllManagedTags());

        $posts->each(function (Post $post, int $key) use ($weeklyBest) {
            WeeklyBestPost::insert([
                'weekly_best_id' => $weeklyBest->id,
                'post_id' => $post->id,
                'rank' => $key + 1,
                'point' => $post->rank_point ?? 0,
            ]);
        });

        return true;
    }
}
