<?php


namespace App\Repositories\Timetable;


interface TimetableRepositoryInterface
{
    public function getAll();
    public function getAllLessons();
    public function getLessonsByGroupAndDate(array $groupIds, $month, $year);
}
