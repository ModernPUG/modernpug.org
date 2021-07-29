<?php

namespace App\Services\Blog;

use GuzzleHttp\Client;

class InvalidImageFilter
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function filter(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        if ($url == 'https://s0.wp.com/i/blank.jpg') {
            return null;
        }

        if (str_contains($url, 'naver.com')) {
            return null;
        }

        if ($this->client->head($url)->getStatusCode() !== 200) {
            return null;
        }

        return $url;
    }
}
