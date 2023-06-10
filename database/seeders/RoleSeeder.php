<?php

namespace Database\Seeders;


use App\Enums\Role as RoleEnum;
use App\Models\Role;
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
        $roles = RoleEnum::SLUGS;

        foreach ($roles as $index => $role) {
            Role::query()->updateOrCreate(
                ['slug' => $role],
                [
                    'name' => RoleEnum::NAMES[$index],
                    'is_hidden' => $role === 'owner'
                ]
            );
        }
    }
}
