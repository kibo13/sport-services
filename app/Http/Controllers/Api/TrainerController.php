<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Trainer\TrainerIndexResource;
use App\Repositories\Trainer\TrainerRepositoryInterface;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function getBySpecialization(Request $request, TrainerRepositoryInterface $trainerRepository)
    {
        $trainers = $trainerRepository->getTrainersBySpecialization($request['specialization_id']);
        $replacementTrainers = collect($trainers)
            ->where('id', '<>', $request['trainer_id'])
            ->values()
            ->all();

        return TrainerIndexResource::collection($replacementTrainers)->toArray(null);
    }
}
