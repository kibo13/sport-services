<?php


namespace App\Repositories\User;


use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    private function createQuery(): Builder
    {
        return User::query();
    }

    public function getDirector()
    {
        return $this->createQuery()
            ->where('role_id', Role::DIRECTOR)
            ->first();
    }
}
