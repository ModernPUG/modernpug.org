<?php

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
            factory(\App\Recruit::class)->times(20)->create();
        }
    }
}
