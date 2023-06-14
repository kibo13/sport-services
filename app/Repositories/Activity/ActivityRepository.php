<?php


namespace App\Repositories\Activity;


use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;

class ActivityRepository implements ActivityRepositoryInterface
{
    private function createQuery(): Builder
    {
        return Activity::query();
    }

    public function getAll()
    {
        return $this->createQuery()->get();
    }

    public function getNameActivityById(int $activityId)
    {
        $activity = $this->createQuery()->find($activityId);

        return $activity->name;
    }

    public function getColorActivityById(int $activityId)
    {
        $activity = $this->createQuery()->find($activityId);

        return $activity->color;
    }
}
