<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TrainerController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rules', [RuleController::class, 'index'])->name('rules.index');

Route::prefix('profile')->as('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::match(['put', 'patch'], '/{user}', [ProfileController::class, 'update'])->name('update');
    Route::post('/photo/update', [ProfileController::class, 'updatePhoto'])->name('update.photo');
});

Route::prefix('services')->as('services.')->group(function () {
    Route::middleware('permission:service_read')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
    });
    Route::middleware('permission:service_full')->group(function () {
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/{service}', [ServiceController::class, 'update'])->name('update');
    });
});

Route::prefix('payments')->as('payments.')->group(function () {
    Route::middleware('permission:pay_read')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
    });
    Route::middleware('permission:pay_full')->group(function () {
        Route::get('/create', [PaymentController::class, 'create'])->name('create');
        Route::post('/', [PaymentController::class, 'store'])->name('store');
        Route::get('/{payment}/edit', [PaymentController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/{payment}', [PaymentController::class, 'update'])->name('update');
        Route::delete('/{payment}', [PaymentController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('cards')->as('cards.')->group(function () {
    Route::middleware('permission:card_read')->group(function () {
        Route::get('/', [CardController::class, 'index'])->name('index');
    });
    Route::middleware('permission:card_full')->group(function () {
        Route::get('/create', [CardController::class, 'create'])->name('create');
        Route::post('/', [CardController::class, 'store'])->name('store');
        Route::get('/{card}/edit', [CardController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/{card}', [CardController::class, 'update'])->name('update');
        Route::delete('/{card}', [CardController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('clients')->as('clients.')->group(function () {
    Route::middleware('permission:client_read')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/export', [ClientController::class, 'export'])->name('export');
    });
    Route::middleware('permission:client_full')->group(function () {
        Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/{client}', [ClientController::class, 'update'])->name('update');
    });
});

Route::prefix('trainers')->as('trainers.')->group(function () {
    Route::middleware('permission:trainer_read')->group(function () {
        Route::get('/', [TrainerController::class, 'index'])->name('index');
        Route::get('/export', [TrainerController::class, 'export'])->name('export');
    });
    Route::middleware('permission:trainer_full')->group(function () {
        Route::get('/{trainer}/edit', [TrainerController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/{trainer}', [TrainerController::class, 'update'])->name('update');
    });
});

Route::prefix('events')->as('events.')->group(function () {
    Route::middleware('permission:event_read')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
    });
    Route::middleware('permission:event_full')->group(function () {
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/{event}', [EventController::class, 'update'])->name('update');
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('permission:report_read')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

Route::middleware('permission:stat_read')->group(function () {
    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
});
