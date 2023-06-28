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

    public function getTotalClientPlaceCount(): int
    {
        return $this->createQuery()
            ->join('places', 'places.client_id', 'users.id')
            ->count();
    }

    public function getClientsWithActivities()
    {
        return $this->createQuery()
            ->select([
                'users.full_name',
                'users.age',
                'users.phone',
                'users.address',
                'activities.name as activity',
            ])
            ->join('cards', 'cards.client_id', 'users.id')
            ->join('activities', 'activities.id', 'cards.activity_id')
            ->where('cards.is_active', true)
            ->distinct()
            ->get();
    }
}
