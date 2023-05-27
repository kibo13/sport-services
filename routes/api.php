<?php

use App\Http\Controllers\Api\SpecializationController;
use Illuminate\Support\Facades\Route;

Route::prefix('specializations')->group(function () {
    Route::get('/get-trainers-by-specialization', [SpecializationController::class, 'getTrainersBySpecialization']);
});
