<?php


namespace App\Repositories\Group;


interface GroupRepositoryInterface
{
    public function getAll();
    public function getGroupsByTrainer(int $trainerId);
}
