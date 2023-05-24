<?php

namespace Database\Seeders;


use App\Models\Permission;
use App\Models\PermissionUser;
use Illuminate\Database\Seeder;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        foreach ([1, 2] as $userId) {
            foreach ($permissions as $permission) {
                PermissionUser::query()->updateOrCreate([
                    'permission_id' => $permission->id,
                    'user_id'       => $userId
                ]);
            }
        }
    }
}
