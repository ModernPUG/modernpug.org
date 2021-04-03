<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (app()->environment('local')) {

            /**
             * @var User $admin
             */
            $admin = User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@modernpug.org',
                'password' => Hash::make('admin'), // admin
            ]);

            $admin->assignRole(Role::all());


            $normalUser = User::factory()->create([
                'name' => 'guest',
                'email' => 'guest@modernpug.org',
                'password' => Hash::make('guest'), // admin
            ]);
        }
    }
}
