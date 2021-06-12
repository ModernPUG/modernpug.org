<?php

namespace Database\Seeders;

use App\Models\ReleaseNews;
use Illuminate\Database\Seeder;

class ReleaseNewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local')) {
            ReleaseNews::factory()->count(random_int(10, 20))->create();
        }
    }
}
