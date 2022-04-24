<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            foreach (Tag::getAllManagedTags() as $tagName) {
                Tag::create(['name' => $tagName]);
            }
        }
    }
}
