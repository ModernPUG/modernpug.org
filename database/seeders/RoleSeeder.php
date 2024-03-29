<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'super-admin', //관리자
            'admin', //사이트 관리자
            'facilitators', //운영진
        ];

        $models = config('permission.models.role');
        $permissions = config('permission.models.permission')::all();

        foreach ($roles as $role) {
            $models::firstOrCreate([
                'name' => $role,
            ])->syncPermissions($permissions);
        }
    }
}
