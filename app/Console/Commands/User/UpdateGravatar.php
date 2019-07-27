<?php

namespace App\Console\Commands\User;

use App\User;
use Creativeorange\Gravatar\Facades\Gravatar;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateGravatar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-gravatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '아바타 이미지가 없는 사용자의 gravatar 정보를 조회 후 업데이트 해줍니다';


    /**
     * Execute the console command.
     *
     * @param  Client  $client
     * @return mixed
     */
    public function handle(Client $client)
    {
        $users = User::whereAvatarUrl(null)->get();

        $users->each(function (User $user) use ($client) {
            $user->avatar_url = Gravatar::get($user->email);
            $user->update();
        });
    }
}
