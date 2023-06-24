<?php


namespace App\Repositories\Timetable;


use App\Models\Timetable;
use Illuminate\Database\Eloquent\Builder;

class TimetableRepository implements TimetableRepositoryInterface
{
    private function createQuery(): Builder
    {
        return Timetable::query();
    }

    public function getAll()
    {
        return $this->createQuery()->get();
    }

    public function getLessonsByGroupAndDate(array $groupIds, $month, $year)
    {
        return $this->createQuery()
            ->selectRaw('COUNT(id) as lessons')
            ->whereIn('group_id', $groupIds)
            ->whereRaw('MONTH(start) = ?', [$month])
            ->whereRaw('YEAR(start) = ?', [$year])
            ->first()
            ->lessons;
    }
}
