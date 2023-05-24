<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\TrainerController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rules', [RuleController::class, 'index'])->name('rules.index');

Route::prefix('profile')->as('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::match(['put', 'patch'], '/{user}', [ProfileController::class, 'update'])->name('update');
    Route::post('/photo/update', [ProfileController::class, 'updatePhoto'])->name('update.photo');
});

Route::prefix('clients')->as('clients.')->group(function () {
    Route::middleware('permission:client_read')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/export', [ClientController::class, 'export'])->name('export');
        Route::get('/{client}', [ClientController::class, 'show'])->name('show');
    });
});

Route::prefix('trainers')->as('trainers.')->group(function () {
    Route::middleware('permission:trainer_read')->group(function () {
        Route::get('/', [TrainerController::class, 'index'])->name('index');
        Route::get('/export', [TrainerController::class, 'export'])->name('export');
        Route::get('/{trainer}', [TrainerController::class, 'show'])->name('show');
    });
});

Route::middleware('permission:report_read')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
