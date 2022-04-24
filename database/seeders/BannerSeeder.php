<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            Banner::factory()->count(random_int(2, 5))->create();
        }
    }
}
