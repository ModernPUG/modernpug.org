<?php

namespace Database\Seeders;

use App\Models\Recruit;
use Illuminate\Database\Seeder;

class RecruitSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            Recruit::factory()->times(20)->create();
            Recruit::factory()->times(5)->close()->create();
        }
    }
}
