<?php


namespace App\Repositories\Event;


use App\Models\Event;
use Carbon\Carbon;
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

    public function getTotalWins($from = null, $till = null): int
    {
        return $this->createQuery()
            ->join('event_results', 'event_results.event_id', 'events.id')
            ->whereNotNull('event_results.client_id')
            ->count();
    }

    public function getPreviousYearWins(): int
    {
        $previousYear = Carbon::now()->subYear()->year;

        return $this->createQuery()
            ->join('event_results', 'event_results.event_id', 'events.id')
            ->whereNotNull('event_results.client_id')
            ->whereYear('events.start', $previousYear)
            ->count();
    }

    public function getCurrentYearWins(): int
    {
        $currentYear = Carbon::now()->year;

        return $this->createQuery()
            ->join('event_results', 'event_results.event_id', 'events.id')
            ->whereNotNull('event_results.client_id')
            ->whereYear('events.start', $currentYear)
            ->count();
    }
}
