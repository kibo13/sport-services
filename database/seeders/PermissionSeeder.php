<?php

namespace Database\Seeders;


use App\Models\Permission;
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
        $permissions = config('permissions');

        foreach ($permissions as $permission) {
            Permission::query()->updateOrCreate([
                'name'       => $permission['name'],
                'slug'       => $permission['slug'],
                'is_setting' => $permission['is_setting'],
                'note'       => $permission['note'],
            ]);
        }
    }
}
