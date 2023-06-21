<?php


namespace App\Repositories\Card;


interface CardLessonRepositoryInterface
{
    public function getLessonsByActivity(int $activityId, $from, $till);
}
