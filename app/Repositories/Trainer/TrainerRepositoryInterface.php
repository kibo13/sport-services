<?php


namespace App\Repositories\Trainer;


interface TrainerRepositoryInterface
{
    public function getAll();
    public function getTrainersBySpecialization(int $specializationId);
    public function getClientCountByTrainer(int $trainerId, $from, $till);
}
