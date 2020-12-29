<?php

namespace App\Services\ReleaseNews;

use App\Models\ReleaseNews as ReleaseNewsModel;
use App\Notifications\ReleaseNews;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class PushReleaseNews
{
    public function pushSlack()
    {
        $releaseNews = $this->getTargetReleaseNews();
        if ($releaseNews->count() !== 0) {
            Notification::route('slack', config('laravel-slack.slack_webhook_url'))
                ->notify(new ReleaseNews($releaseNews));
        }
    }

    /**
     * @return ReleaseNews[]|Collection
     */
    private function getTargetReleaseNews()
    {
        return ReleaseNewsModel::getPushReleaseNews();
    }
}
