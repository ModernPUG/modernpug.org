<?php

namespace App\Jobs\Slack\SlashCommands;

use Spatie\SlashCommand\Jobs\SlashCommandResponseJob;

class PickerDelayedResponse extends SlashCommandResponseJob
{
    const MAX_DELAYED_COUNT = 3;
    const DELAY_SECOND = 2;

    /**
     * @var array
     */
    protected $pickedUsers;

    /**
     * Create a new job instance.
     * @param array $pickedUsers
     */
    public function __construct(array $pickedUsers)
    {
        $this->pickedUsers = $pickedUsers;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        for ($i = 0; $i < self::MAX_DELAYED_COUNT; $i++) {
            $this->respondToSlack(self::MAX_DELAYED_COUNT - $i)->displayResponseToEveryoneOnChannel()->send();
            sleep(self::DELAY_SECOND);
        }

        $taggedUsers = array_map(function ($user) {
            return '<@' . $user . '>';
        }, $this->pickedUsers);

        $pickerMessage = '추첨결과 : ' . implode($taggedUsers, ', ') . '님이 당첨되었습니다. 축하드립니다 :tada:';
        $this->respondToSlack($pickerMessage)->displayResponseToEveryoneOnChannel()->send();
    }
}
