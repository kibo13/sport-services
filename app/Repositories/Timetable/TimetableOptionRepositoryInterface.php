<?php


namespace App\Repositories\Timetable;


interface TimetableOptionRepositoryInterface
{
    public function getAll();
    public function getTotalLessonsForGroups(array $groupIds);
    public function getTimetableOptionByDayAndGroup(int $groupId, int $dayOfWeek);
}
