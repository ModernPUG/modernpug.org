<?php

namespace App\Services\Slack;

use App\Exceptions\AlreadyInTeamException;
use App\Exceptions\AlreadyInTeamInvitedUserException;
use App\Exceptions\AlreadyInvitedException;
use App\Exceptions\SlackInviteFailException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Inviter
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param  string  $email
     *
     * @throws GuzzleException
     * @throws SlackInviteFailException
     * @throws AlreadyInvitedException
     * @throws AlreadyInTeamException
     * @throws AlreadyInTeamInvitedUserException
     */
    public function invite(string $email): bool
    {
        $uri = config('slack.url').'/api/users.admin.invite?t='.time();

        $response = $this->client->request(
            'post',
            $uri,
            [
                'form_params' => [
                    'token' => config('slack.token'),
                    'email' => $email,
                    'channels' => config('slack.invite-channels'),
                    //'ultra_restricted' => 1,
                    'set_active' => true,
                    '_attempts' => 1,
                ],
            ]
        );

        $result = json_decode($response->getBody()->getContents());

        if (! $result->ok) {
            if ($result->error === 'already_invited') {
                throw new AlreadyInvitedException();
            } elseif ($result->error === 'already_in_team') {
                throw new AlreadyInTeamException();
            } elseif ($result->error === 'already_in_team_invited_user') {
                throw new AlreadyInTeamInvitedUserException();
            } else {
                throw new SlackInviteFailException($result->error);
            }
        }

        return true;
    }
}
