<?php

namespace Database\Seeders;

use App\Models\Point;
use App\Models\User;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            User::all()->each(function (User $user) {
                Point::factory()->count(random_int(1, 5))->create([
                    'receive_user_id' => $user->id,
                ]);
            });
        }
    }
}
