<?php

namespace App\Console\Commands\User;

use App\Role;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RemoveRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:remove-role
                        {user? : 유저의 이메일을 입력해주세요}
                        {role? : role의 이름을 입력해주세요}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '유저에게 Role을 제거합니다';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->getUserFromArgument();

        if (! $user) {
            $user = $this->askUserEmail();
        }

        if (! $user) {
            $this->warn('유저를 찾지 못하였습니다');

            return false;
        }

        $role = $this->getRoleFromArgument();

        if (! $role) {
            $role = $this->askRole($user);
        }

        if (! $role) {
            $this->warn('role을 찾지 못하였습니다');

            return false;
        }

        if ($this->askRemoveRole($user, $role)) {
            $user->removeRole($role);
        } else {
            $this->info('요청이 취소되었습니다');
        }

        if ($user->roles->count()) {
            $this->info("{$user->name}에게 {$user->roles->pluck('name')->implode(',')} 권한이 있습니다");
        } else {
            $this->info("{$user->name}의 모든 권한이 제거되었습니다");
        }
    }

    /**
     * @return mixed
     */
    private function askUserEmail(): ?User
    {
        for ($i = 0; $i < 5; $i++) {
            try {
                $email = $this->ask('해당 유저의 이메일을 입력해주세요');

                return User::whereEmail($email)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $this->warn('유저를 찾을 수 없습니다');
            }
        }

        $this->warn('5회이상 잘못된 유저를 입력하여 명령을 종료합니다');

        return null;
    }

    private function askRole(User $user): string
    {
        $roles = Role::all();

        $this->table(['Roles'], [$user->roles->pluck('name')->toArray()]);

        for ($i = 0; $i < 5; $i++) {
            $role = $this->ask('제거할 Role을 입력해주세요', '');

            if ($roles->contains('name', $role)) {
                return $role;
            }
        }

        return false;
    }

    /**
     * @param User|null $user
     * @param string $role
     * @return bool
     */
    private function askRemoveRole(User $user, string $role): bool
    {
        return $this->confirm("[{$user->name}]{$user->email}유저에게 [{$role}] role을 제거합니다. 맞습니까?");
    }

    private function getUserFromArgument(): ?User
    {
        $user = $this->argument('user');

        if (! $user) {
            return null;
        }

        return User::whereEmail($user)->firstOrFail();
    }

    private function getRoleFromArgument()
    {
        try {
            $role = $this->argument('role');

            if (! $role) {
                return;
            }

            return Role::whereName($role)->firstOrFail()->name;
        } catch (ModelNotFoundException $exception) {
            $this->warn("입력하신 {$role} role은 존재하지 않습니다");

            return;
        }
    }
}
