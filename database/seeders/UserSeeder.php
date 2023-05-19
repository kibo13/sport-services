<?php

namespace Database\Seeders;


use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->updateOrCreate([
            'role_id'    => Role::ADMIN,
            'name'       => 'Баймен',
            'surname'    => 'Ермекбаев',
            'patronymic' => 'Владимирович',
            'birthday'   => '2003-06-20',
            'phone'      => '7777777777',
            'email'      => 'admin@sport.ru',
            'password'   => Hash::make('tyler13'),
        ]);
    }
}
