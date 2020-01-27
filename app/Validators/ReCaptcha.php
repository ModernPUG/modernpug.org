<?php

namespace App\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
    public const ACCEPT_TEST_KEY = 'test';

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function validate($attribute, $value, $parameters, $validator)
    {
        if (app()->environment('testing')) {
            return $value == self::ACCEPT_TEST_KEY;
        }

        $response = $this->client->post('https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => config('recaptcha.secret'),
                    'response' => $value,
                ],
            ]
        );
        $body = json_decode((string) $response->getBody());

        return $body->success;
    }
}
