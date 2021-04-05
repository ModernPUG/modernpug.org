<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-restore',

            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete',
            'blog-restore',

            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-restore',

            'recruit-list',
            'recruit-create',
            'recruit-edit',
            'recruit-delete',
            'recruit-restore',

            'banner-list',
            'banner-create',
            'banner-edit',
            'banner-delete',
            'banner-restore',
            'banner-allow',
            'banner-disallow',


            'point-list',
        ];

        $models = config('permission.models.permission');

        foreach ($permissions as $permission) {
            $models::firstOrCreate([
                'name' => $permission,
            ]);
        }
    }
}
