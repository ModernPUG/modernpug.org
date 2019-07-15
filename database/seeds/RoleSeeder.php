<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            'super-admin', //관리자
            'admin', //사이트 관리자
            'facilitators', //운영진
        ];


        $models = config('permission.models.role');
        $permissions = \Spatie\Permission\Models\Permission::all();

        foreach ($roles as $role) {

            $models::firstOrCreate([
                'name' => $role,
            ])->syncPermissions($permissions);
        }

    }
}
