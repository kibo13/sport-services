<?php

use App\Http\Controllers\Admin\CardLessonController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\MedicalCardController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TimetableController;
use App\Http\Controllers\Admin\TimetableOptionController;
use App\Http\Controllers\Admin\TrainerController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rules', [RuleController::class, 'index'])->name('rules.index');

Route::prefix('profile')->as('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::match(['put', 'patch'], '/{user}', [ProfileController::class, 'update'])->name('update');
    Route::post('/photo/update', [ProfileController::class, 'updatePhoto'])->name('update.photo');
});

Route::prefix('lessons')->as('lessons.')->group(function () {
    Route::middleware('permission:lesson_read')->group(function () {
        Route::get('/', [CardLessonController::class, 'index'])->name('index');
    });
    Route::middleware('permission:lesson_full')->group(function () {
        Route::get('/management', [CardLessonController::class, 'management'])->name('management');
        Route::match(['put', 'patch'], '/{lesson}', [CardLessonController::class, 'update'])->name('update');
    });
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

Route::prefix('timetable')->as('timetable.')->group(function () {
    Route::middleware('permission:timetable_read')->group(function () {
        Route::get('/', [TimetableController::class, 'index'])->name('index');
    });
    Route::middleware('permission:timetable_full')->group(function () {
        Route::post('/replace-trainer', [TimetableController::class, 'replaceTrainer'])->name('replace.trainer');
        Route::post('/generate', [TimetableController::class, 'generate'])->name('generate');
        Route::post('/update-or-create', [TimetableOptionController::class, 'updateOrCreate'])->name('update.or.create');
        Route::delete('/{timetableOption}', [TimetableOptionController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('payments')->as('payments.')->group(function () {
    Route::middleware('permission:pay_read')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/{payment}/receipt', [PaymentController::class, 'generateReceipt'])->name('receipt');
    });
    Route::middleware('permission:pay_full')->group(function () {
        Route::get('/create', [PaymentController::class, 'create'])->name('create');
        Route::post('/', [PaymentController::class, 'store'])->name('store');
    });
});

Route::prefix('cards')->as('cards.')->group(function () {
    Route::middleware('permission:card_read')->group(function () {
        Route::get('/', [CardController::class, 'index'])->name('index');
        Route::get('/{card}/generate', [CardController::class, 'generate'])->name('generate');
        Route::get('/{card}/payback', [CardController::class, 'payback'])->name('payback');
    });
});

Route::prefix('groups')->as('groups.')->group(function () {
    Route::middleware('permission:group_read')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('index');
    });
    Route::middleware('permission:group_full')->group(function () {
        Route::get('/create', [GroupController::class, 'create'])->name('create');
        Route::post('/', [GroupController::class, 'store'])->name('store');
        Route::get('/{group}/edit', [GroupController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/{group}', [GroupController::class, 'update'])->name('update');
        Route::delete('/{group}', [GroupController::class, 'destroy'])->name('destroy');
        Route::post('/place/bind', [GroupController::class, 'bindPlace'])->name('place.bind');
        Route::post('/place/unbind', [GroupController::class, 'unbindPlace'])->name('place.unbind');
    });
});

Route::prefix('clients')->group(function () {
    Route::middleware('permission:client_read')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    });
    Route::middleware('permission:client_full')->group(function () {
        Route::get('/export', [ClientController::class, 'export'])->name('clients.export');
        Route::get('/create', [ClientController::class, 'create'])->name('payments.clients.create');
        Route::post('/', [ClientController::class, 'store'])->name('payments.clients.store');
        Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
        Route::match(['put', 'patch'], '/{client}', [ClientController::class, 'update'])->name('clients.update');
    });
    Route::middleware('permission:medical_read')->group(function () {
        Route::get('/{client}/medical-card/{medicalCard}', [MedicalCardController::class, 'edit'])->name('clients.medical.card.edit');
    });
    Route::middleware('permission:medical_full')->group(function () {
        Route::match(['put', 'patch'], '/medical-card/{medicalCard}', [MedicalCardController::class, 'update'])->name('clients.medical.card.update');
    });
});

Route::prefix('trainers')->as('trainers.')->group(function () {
    Route::middleware('permission:trainer_read')->group(function () {
        Route::get('/', [TrainerController::class, 'index'])->name('index');
    });
    Route::middleware('permission:trainer_full')->group(function () {
        Route::get('/export', [TrainerController::class, 'export'])->name('export');
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
        Route::get('/{result}/result', [EventController::class, 'getResult'])->name('result');
        Route::post('/{result}/set', [EventController::class, 'setResult'])->name('result.set');
    });
});

Route::prefix('options')->as('options.')->group(function () {
    Route::middleware('permission:option_read')->group(function () {
        Route::get('/', [OptionController::class, 'index'])->name('index');
    });
    Route::middleware('permission:option_full')->group(function () {
        Route::match(['put', 'patch'], '/{option}', [OptionController::class, 'update'])->name('update');
    });
});

Route::prefix('reports')->as('reports.')->group(function () {
    Route::middleware('permission:report_read')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/clients', [ReportController::class, 'clients'])->name('clients');
        Route::get('/groups', [ReportController::class, 'groups'])->name('groups');
        Route::get('/events', [ReportController::class, 'events'])->name('events');
        Route::get('/results', [ReportController::class, 'results'])->name('results');
        Route::get('/payments', [ReportController::class, 'payments'])->name('payments');
    });
});

Route::middleware('permission:stat_read')->group(function () {
    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
});
