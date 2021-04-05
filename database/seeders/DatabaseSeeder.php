<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PointSeeder::class);


        $this->call(TagSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(WeeklyBestSeeder::class);

        $this->call(RecruitSeeder::class);
        $this->call(ReleaseNewSeeder::class);
        $this->call(BannerSeeder::class);
    }
}
