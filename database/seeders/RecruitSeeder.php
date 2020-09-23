<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local')) {
            factory(\App\Models\Recruit::class)->times(20)->create();
        }
    }
}
