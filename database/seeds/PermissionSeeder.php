<?php

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
        ];


        $models = config('permission.models.permission');

        foreach ($permissions as $permission) {

            $models::firstOrCreate([
                'name' => $permission,
            ]);
        }

    }
}
