<?php

namespace App\Services\Jumpit;

use GuzzleHttp\Client;

class SearchRecruits
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getRecruits()
    {
        $contents = $this->client
            ->get('https://api.jumpit.co.kr/modernpug/positions')
            ->getBody()
            ->getContents();

        return json_decode($contents);
    }
}
