<?php


namespace App\Repositories\Card;


interface CardRepositoryInterface
{
    public function getActiveLessonsByActivitiesAndClient(array $activities, int $clientId);
}
