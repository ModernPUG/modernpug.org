<?php


namespace Tests;


use DB;
use Laravel\Passport\ClientRepository;

trait MakePassportClient
{

    public function makePassportPersonalClient()
    {
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            config('app.url')
        );

        DB::table('oauth_personal_access_clients')->insert(
            [
                'client_id' => $client->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return $client;
    }

}
