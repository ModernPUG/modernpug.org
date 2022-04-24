<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            Blog::all()->each(function (Blog $blog) {
                Post::factory()->count(random_int(5, 20))->create(['blog_id' => $blog])->each(function (Post $post) {
                    $post->tags()->saveMany(Tag::inRandomOrder()->limit(random_int(0, 5))->get());
                });
            });
        }
    }
}
