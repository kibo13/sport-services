<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\Trainer\TrainerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function getTrainersBySpecialization(Request $request, TrainerRepositoryInterface $trainerRepository): JsonResponse
    {
        try {
            $trainers = $trainerRepository->getTrainersBySpecialization($request['specialization_id']);
            $options = $trainers->map(function ($trainer) {
                return '<option value="' . $trainer->id . '">' . $trainer->full_name . '</option>';
            })->prepend('<option value="" disabled hidden selected>Выберите</option>')->implode('');

            return response()->json(['status' => 1, 'option' => $options]);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
