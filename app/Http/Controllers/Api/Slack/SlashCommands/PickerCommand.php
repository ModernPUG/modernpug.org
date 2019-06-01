<?php

namespace App\Http\Controllers\Api\Slack\SlashCommands;

use JoliCode\Slack\Api\Client;
use App\Services\Slack\Channel;
use Spatie\SlashCommand\Request;
use Spatie\SlashCommand\Response;
use Spatie\SlashCommand\Attachment;
use Spatie\SlashCommand\Handlers\BaseHandler;
use App\Jobs\Slack\SlashCommands\PickerDelayedResponse;

class PickerCommand extends BaseHandler
{
    /**
     * If this function returns true, the handle method will get called.
     * @param Request $request
     * @return bool
     */
    public function canHandle(Request $request): bool
    {
        return $request->command === '추첨';
    }

    /**
     * Handle the given request. Remember that Slack expects a response
     * within three seconds after the slash command was issued. If
     * there is more time needed, dispatch a job.
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $channelId = $request->channelId;
        $userId = $request->userId;

        $text = $request->text;

        if (empty($text)) {
            $pickCount = 1;
            $message = null;
        } elseif (strlen($text) == 1) {
            $pickCount = $text;
            $message = null;
        } else {
            [$pickCount, $message] = explode(' ', $text ?: 1, 2);
        }

        $channelInformation = json_decode(app(Client::class)->channelsInfo(['channel' => $channelId])->getBody()->getContents());

        $users = $channelInformation->channel->members;
        $userCount = count($users);

        if (! is_numeric($pickCount)) {
            return $this->respondToSlack($pickCount.'는 숫자만 입력가능합니다');
        }

        if ($userCount < $pickCount) {
            $responseText = $pickCount.'는 실제 사용자보다 더 많습니다. '.$userCount.'이하의 숫  자를 입력해주세요';

            return $this->respondToSlack($responseText);
        }

        $pickedUser = array_random($users, $pickCount);

        $this->dispatch(new PickerDelayedResponse($pickedUser));

        $responseText = "<@{$userId}> 님에 의해 ".($message ? "*{$message}* " : '').'추첨이 시작되었습니다.';

        return $this->respondToSlack($responseText)
            ->withAttachment(Attachment::create()
                ->setColor('good')
                ->setText('응모자 : '.number_format($userCount).'명')
            )
            ->withAttachment(Attachment::create()
                ->setColor('good')
                ->setText('추첨자 : '.number_format($pickCount).'명')
            )
            ->withAttachment(Attachment::create()
                ->setColor('good')
                ->setText('확률 : '.number_format(100 / $userCount * $pickCount, 2).'%')
            )
            ->displayResponseToEveryoneOnChannel();
    }
}
