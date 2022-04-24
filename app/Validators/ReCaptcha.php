<?php

namespace App\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
    public const ACCEPT_TEST_KEY = 'test';

    public function __construct(private Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        if (app()->environment('testing')) {
            return $value === self::ACCEPT_TEST_KEY;
        }

        $response = $this->client->post('https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => config('recaptcha.secret'),
                    'response' => $value,
                ],
            ]
        );
        $body = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        return $body->success;
    }
}
