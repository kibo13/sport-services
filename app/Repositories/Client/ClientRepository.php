<?php


namespace App\Repositories\Client;


use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ClientRepository implements ClientRepositoryInterface
{
    private function createQuery(): Builder
    {
        return User::query();
    }

    public function getAll()
    {
        return $this->createQuery()
            ->where('role_id', Role::CLIENT)
            ->get();
    }

    public function getTotalClientsCount(): int
    {
        return $this->createQuery()
            ->where('role_id', Role::CLIENT)
            ->count();
    }
}
