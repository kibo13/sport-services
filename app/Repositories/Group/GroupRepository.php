<?php


namespace App\Repositories\Group;


use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;

class GroupRepository implements GroupRepositoryInterface
{
    private function createQuery(): Builder
    {
        return Group::query();
    }

    public function getAllGroups()
    {
        return $this->createQuery()
            ->get();
    }

    public function getGroupsByTrainer(int $trainerId)
    {
        return $this->createQuery()
            ->where('trainer_id', $trainerId)
            ->get();
    }
}
