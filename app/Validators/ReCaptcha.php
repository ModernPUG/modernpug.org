<?php

namespace App\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
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
