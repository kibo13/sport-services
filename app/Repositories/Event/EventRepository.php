<?php


namespace App\Repositories\Event;


use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class EventRepository implements EventRepositoryInterface
{
    private function createQuery(): Builder
    {
        return Event::query();
    }

    public function getAll($from = null, $till = null)
    {
        $query = $this->createQuery();

        if ($from && $till) {
            $query->whereBetween('start', [$from, $till]);
        }

        return $query
            ->orderBy('start')
            ->get();
    }

    public function getTotalEventsCount($from = null, $till = null): int
    {
        $query = $this->createQuery();

        if ($from && $till) {
            $query->whereBetween('start', [$from, $till]);
        }

        return $query->count();
    }

    public function getEventsByActivity(int $activityId, $from, $till)
    {
        return $this->createQuery()
            ->select([
                DB::raw('DATE_FORMAT(start, \'%m.%Y\') AS period'),
                DB::raw('COUNT(id) AS count')
            ])
            ->where('activity_id', $activityId)
            ->whereBetween('start', [$from, $till])
            ->groupBy('period')
            ->get();
    }
}
