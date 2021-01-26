<?php

namespace App\Services\Recruits;

use App\Models\Recruit as RecruitModel;
use App\Notifications\Recruit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class PushDailyNewRecruits
{
    public function pushSlack()
    {
        $recruits = $this->getTargetRecruit();
        if ($recruits->count() !== 0) {
            Notification::route('slack', config('laravel-slack.slack_webhook_url'))
                ->notify(new Recruit($recruits));
        }
    }

    /**
     * @return Recruit[]|Collection
     */
    private function getTargetRecruit()
    {
        return RecruitModel::getDailyPushTargets();
    }
}
