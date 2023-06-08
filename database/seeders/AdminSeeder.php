<?php

namespace Database\Seeders;


use App\Enums\Role;
use App\Models\PermissionUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'role_id'    => Role::ADMIN,
                'name'       => 'Борис',
                'surname'    => 'Ким',
                'patronymic' => 'Юрьевич',
                'birthday'   => '1990-10-13',
                'phone'      => '7717777777',
                'email'      => 'kimboris1310@gmail.com',
                'password'   => Hash::make('secret'),
                'is_hidden'  => true,
            ],
            [
                'role_id'    => Role::ADMIN,
                'name'       => 'Баймен',
                'surname'    => 'Ермекбаев',
                'patronymic' => 'Владимирович',
                'birthday'   => null,
                'phone'      => '7077777777',
                'email'      => 'BaimenVip@mail.ru',
                'password'   => Hash::make('secret'),
                'is_hidden'  => false,
            ]
        ];

        foreach ($admins as $admin) {
            $user = User::query()->updateOrCreate($admin);
            $this->syncPermissionsForUser($user);
        }
    }

    /**
     * Sync permissions for a user based on their role.
     *
     * @param  User  $user
     * @return void
     */
    private function syncPermissionsForUser(User $user)
    {
        $permissions = config('permissions');

        foreach ($permissions as $permission_id => $permission) {
            if (in_array($user['role_id'], $permission['roles'])) {
                PermissionUser::query()->updateOrCreate([
                    'permission_id' => ++$permission_id,
                    'user_id' => $user['id']
                ]);
            }
        }
    }
}
