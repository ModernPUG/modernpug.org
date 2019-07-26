<?php

namespace App\Services;

use App\Exceptions\AlreadyInTeamException;
use App\Exceptions\AlreadyInvitedException;
use App\Exceptions\SlackInviteFailException;
use GuzzleHttp\Client;

/**
 * Class SlackInviter.
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
     * @throws AlreadyInvitedException
     * @throws AlreadyInTeamException
     */
    public function invite(string $email)
    {
        $uri = config('slack.url').'/api/users.admin.invite?t='.time();

        $response = $this->client->request('post', $uri, [
            'form_params' => [
                'token' => config('slack.token'),
                'email' => $email,
                'channels' => config('slack.invite-channels'),
                //'ultra_restricted' => 1,
                'set_active' => true,
                '_attempts' => 1,
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());

        if (! $result->ok) {
            if ($result->error == 'already_invited') {
                throw new AlreadyInvitedException();
            } elseif ($result->error == 'already_in_team') {
                throw new AlreadyInTeamException();
            } else {
                throw new SlackInviteFailException($result->error);
            }
        }
    }
}
