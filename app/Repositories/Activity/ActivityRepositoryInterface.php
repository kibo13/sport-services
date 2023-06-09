<?php


namespace App\Repositories\Activity;


interface ActivityRepositoryInterface
{
    public function getNameActivityById(int $activityId);
    public function getColorActivityById(int $activityId);
}
