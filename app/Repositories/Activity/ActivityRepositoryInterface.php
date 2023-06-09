<?php


namespace App\Repositories\Activity;


interface ActivityRepositoryInterface
{
    public function getAllActivities();
    public function getNameActivityById(int $activityId);
    public function getColorActivityById(int $activityId);
}
