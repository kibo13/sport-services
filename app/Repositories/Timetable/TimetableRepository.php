<?php


namespace App\Repositories\Timetable;


use App\Models\Timetable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

    public function getAllLessons()
    {
        return $this->createQuery()
            ->join('activities', 'activities.id', 'timetables.activity_id')
            ->join('groups', 'groups.id', 'timetables.group_id')
            ->join('users', 'users.id', 'timetables.trainer_id')
            ->select([
                'activities.id as activity_id',
                'activities.name as activity',
                'groups.name as group',
                'groups.color as bgColor',
                'users.full_name as trainer',
                'timetables.id as timetable_id',
                'timetables.start',
                'timetables.end',
                DB::raw('CONCAT_WS(\'-\', DATE_FORMAT(timetables.start, \'%H:%i\'), DATE_FORMAT(timetables.end, \'%H:%i\')) as title'),
                'timetables.trainer_id',
                'timetables.is_replace',
                'timetables.note',
            ])
            ->get();
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
