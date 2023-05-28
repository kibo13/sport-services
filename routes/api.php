<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\SpecializationController;
use Illuminate\Support\Facades\Route;

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
});

Route::prefix('specializations')->group(function () {
    Route::get('/get-trainers-by-specialization', [SpecializationController::class, 'getTrainersBySpecialization']);
});
