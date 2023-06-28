<?php


namespace App\Repositories\Event;


interface EventRepositoryInterface
{
    public function getAll($from = null, $till = null);
    public function getTotalEventsCount($from = null, $till = null);
    public function getEventsByActivity(int $activityId, $from, $till);
    public function getTotalWins($from = null, $till = null);
    public function getPreviousYearWins();
    public function getCurrentYearWins();
}
