<?php


namespace App\Repositories\Activity;


interface ActivityRepositoryInterface
{
    public function getAll();
    public function getNameActivityById(int $activityId);
    public function getColorActivityById(int $activityId);
}
