<?php


namespace App\Repositories\Card;


use App\Models\Card;
use Illuminate\Database\Eloquent\Builder;

class CardRepository implements CardRepositoryInterface
{
    private function createQuery(): Builder
    {
        return Card::query();
    }

    public function getActiveLessonsByActivitiesAndClient(array $activities, int $clientId)
    {
        return $this->createQuery()
            ->with('lessons')
            ->whereIn('activity_id', $activities)
            ->where('client_id', $clientId)
            ->where('is_active', true)
            ->orderBy('activity_id')
            ->get();
    }
}
