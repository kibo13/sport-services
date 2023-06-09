<?php


namespace App\Repositories\Event;


interface EventRepositoryInterface
{
    public function getEventsByActivity(int $activityId, $from, $till);
}
