<?php


namespace App\Repositories\Trainer;


use App\Enums\Role;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function getClientCountByTrainer(int $trainerId, $from, $till): Collection
    {
        return DB::table('places')
            ->select([
                DB::raw('DATE_FORMAT(places.busy_at, \'%m.%Y\') AS period'),
                DB::raw('COUNT(places.id) AS count')
            ])
            ->join('groups', 'groups.id', 'places.group_id')
            ->join('users', 'users.id', 'groups.trainer_id')
            ->where('groups.trainer_id', $trainerId)
            ->whereBetween('places.busy_at', [$from, $till])
            ->groupBy('period')
            ->get();
    }
}
