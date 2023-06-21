<?php

namespace Database\Seeders;


use App\Enums\Role;
use App\Models\User;
use App\Traits\PermissionSyncTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    use PermissionSyncTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! User::query()->where('role_id', Role::OWNER)->exists()) {
            $user = $this->createOwnerUser();
            $this->syncPermissionsForUser($user);
        }
    }


    /**
     * Create a user with the role of owner.
     *
     * @return Builder|Model
     */
    private function createOwnerUser()
    {
        return User::query()->create([
            'role_id'    => Role::OWNER,
            'name'       => 'Баймен',
            'surname'    => 'Ермекбаев',
            'patronymic' => 'Владимирович',
            'email'      => 'BaimenVip@mail.ru',
            'password'   => Hash::make('secret'),
        ]);
    }
}
