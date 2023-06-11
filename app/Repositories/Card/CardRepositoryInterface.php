<?php


namespace App\Repositories\Card;


interface CardRepositoryInterface
{
    public function getActiveCards();
    public function getInactiveCards();
    public function getActiveLessonsByActivitiesAndClient(array $activities, int $clientId);
}
