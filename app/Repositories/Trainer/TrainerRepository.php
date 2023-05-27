<?php


namespace App\Repositories\Trainer;


use App\Enums\Role;
use App\Models\Specialization;
use App\Models\User;

class TrainerRepository implements TrainerRepositoryInterface
{
    public function getAll()
    {
        return User::query()
            ->where('role_id', Role::INSTRUCTOR)
            ->get();
    }

    public function getTrainersBySpecialization(int $specializationId)
    {
        $specialization = Specialization::query()->findOrFail($specializationId);

        return $specialization->trainers;
    }
}
