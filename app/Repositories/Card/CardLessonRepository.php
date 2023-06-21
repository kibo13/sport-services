<?php


namespace App\Repositories\Card;


use App\Models\CardLesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CardLessonRepository implements CardLessonRepositoryInterface
{
    private function createQuery(): Builder
    {
        return CardLesson::query();
    }

    public function getLessonsByActivity(int $activityId, $from, $till)
    {
        return $this->createQuery()
            ->select([
                DB::raw('DATE_FORMAT(card_lessons.attended_at, \'%m.%Y\') AS period'),
                DB::raw('COUNT(card_lessons.id) AS count')
            ])
            ->join('cards', 'cards.id', 'card_lessons.card_id')
            ->where('cards.activity_id', $activityId)
            ->whereBetween('card_lessons.attended_at', [$from, $till])
            ->groupBy('period')
            ->get();
    }
}
