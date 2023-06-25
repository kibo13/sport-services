<?php

use App\Http\Controllers\Api\TimetableController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\TrainerController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/timetable', [TimetableController::class, 'index']);
    Route::get('/specializations/get-trainers-by-specialization', [SpecializationController::class, 'getTrainersBySpecialization']);
    Route::get('/clients/search', [ClientController::class, 'search']);
    Route::get('/trainers/get-by-specialization', [TrainerController::class, 'getBySpecialization']);
});
