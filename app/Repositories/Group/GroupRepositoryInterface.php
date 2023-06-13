<?php


namespace App\Repositories\Group;


interface GroupRepositoryInterface
{
    public function getAllGroups();
    public function getGroupsByTrainer(int $trainerId);
}
