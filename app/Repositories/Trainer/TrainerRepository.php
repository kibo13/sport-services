<?php


namespace App\Repositories\Trainer;


use App\Enums\Role;
use App\Models\User;

class TrainerRepository implements TrainerRepositoryInterface
{
    public function getAll()
    {
        return User::query()
            ->where('role_id', Role::INSTRUCTOR)
            ->get();
    }
}
