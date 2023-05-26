<?php


namespace App\Repositories\Client;


use App\Enums\Role;
use App\Models\User;

class ClientRepository implements ClientRepositoryInterface
{
    public function getAll()
    {
        return User::query()
            ->where('role_id', Role::CLIENT)
            ->get();
    }
}
