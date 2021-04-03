<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (app()->environment('local')) {

            Blog::firstOrCreate([
                'feed_url' => 'http://88240.tistory.com/rss',
            ], [
                'title' => '',
                'site_url' => '',
            ]);
        }
    }
}
