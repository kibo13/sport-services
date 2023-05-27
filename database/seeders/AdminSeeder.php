<?php

namespace Database\Seeders;


use App\Enums\Role;
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
                'phone'      => '7713404056',
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
                'phone'      => '7718203830',
                'email'      => 'BaimenVip@mail.ru',
                'password'   => Hash::make('secret'),
                'is_hidden'  => false,
            ]
        ];

        foreach ($admins as $admin) {
            User::query()->updateOrCreate($admin);
        }
    }
}
