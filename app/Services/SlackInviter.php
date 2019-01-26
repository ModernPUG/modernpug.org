<?php


namespace App\Services;


use App\Exceptions\SlackInviteFailException;
use GuzzleHttp\Client;

/**
 * Class SlackInviter
 * @package App\Services
 * 슬랙의 레거시 토큰이 필요합니다. 발급받은 해당 사용자의 명의로 초대장이 발송됩니다
 * https://api.slack.com/custom-integrations/legacy-tokens
 */
class SlackInviter
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $email
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws SlackInviteFailException
     */
    public function invite(string $email)
    {

        $uri = config('slack.url') . '/api/users.admin.invite?t=' . time();

        $response = $this->client->request('post', $uri, [
            'form_params' => [
                'token' => config('slack.token'),
                'email' => $email,
                'channels' => config('slack.channels'),
                //'ultra_restricted' => 1,
                'set_active' => true,
                '_attempts'=>1,
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());

        if (!$result->ok) {
            throw new SlackInviteFailException($result->error);
        }

    }
}