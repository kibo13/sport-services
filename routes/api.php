<?php

use App\Http\Controllers\Api\TimetableController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\TrainerController;
use Illuminate\Support\Facades\Route;

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
});

Route::prefix('timetable')->group(function () {
    Route::get('/', [TimetableController::class, 'index']);
});

Route::prefix('specializations')->group(function () {
    Route::get('/get-trainers-by-specialization', [SpecializationController::class, 'getTrainersBySpecialization']);
});

Route::prefix('clients')->group(function () {
    Route::get('/search', [ClientController::class, 'search']);
});

Route::prefix('trainers')->group(function () {
    Route::get('/get-by-specialization', [TrainerController::class, 'getBySpecialization']);
});
