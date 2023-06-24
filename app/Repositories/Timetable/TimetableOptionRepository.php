<?php


namespace App\Repositories\Timetable;


use App\Models\TimetableOption;
use Illuminate\Database\Eloquent\Builder;

class TimetableOptionRepository implements TimetableOptionRepositoryInterface
{
    private function createQuery(): Builder
    {
        return TimetableOption::query();
    }

    public function getAll()
    {
        return $this->createQuery()->get();
    }

    public function getTimetableOptionByDayAndGroup(int $groupId, int $dayOfWeek)
    {
        return $this->createQuery()
            ->where('group_id', $groupId)
            ->where('day_of_week', $dayOfWeek)
            ->first();
    }
}
