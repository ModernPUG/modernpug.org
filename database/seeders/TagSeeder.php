<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local')) {
            foreach (Tag::getAllManagedTags() as $tagName) {
                Tag::create(['name' => $tagName]);
            }
        }
    }
}
