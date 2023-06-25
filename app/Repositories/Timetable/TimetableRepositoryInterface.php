<?php


namespace App\Repositories\Timetable;


use App\Models\User;

interface TimetableRepositoryInterface
{
    public function getAll();
    public function getAllLessons(User $user);
    public function getLessonsByGroupAndDate(array $groupIds, $month, $year);
}
