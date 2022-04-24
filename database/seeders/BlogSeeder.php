<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            Blog::factory()->count(random_int(5, 20))->create();
        }
    }
}
