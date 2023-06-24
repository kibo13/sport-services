<?php


namespace App\Repositories\Timetable;


interface TimetableOptionRepositoryInterface
{
    public function getAll();
    public function getTimetableOptionByDayAndGroup(int $groupId, int $dayOfWeek);
}
