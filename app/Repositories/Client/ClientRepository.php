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

    public function getUsersWithActivities()
    {
        return $this->createQuery()
            ->select([
                'users.full_name',
                'users.age',
                'users.phone',
                'users.address',
                'activities.name AS activity',
            ])
            ->leftJoin('places', 'places.client_id', 'users.id')
            ->leftJoin('groups', 'groups.id', 'places.group_id')
            ->leftJoin('activities', 'activities.id', 'groups.activity_id')
            ->where('users.role_id', Role::CLIENT)
            ->get();
    }
}
