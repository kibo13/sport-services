<?php


use App\Http\Controllers\Admin\BenefitController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('catalog')->group(function () {
    Route::middleware('admin')->group(function () {

        // Услуги
        Route::prefix('services')->as('services.')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/', [ServiceController::class, 'store'])->name('store');
            Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
            Route::match(['put', 'patch'], '/{service}', [ServiceController::class, 'update'])->name('update');
            Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
        });

        // Льготники
        Route::prefix('benefits')->as('benefits.')->group(function () {
            Route::get('/', [BenefitController::class, 'index'])->name('index');
            Route::get('/create', [BenefitController::class, 'create'])->name('create');
            Route::post('/', [BenefitController::class, 'store'])->name('store');
            Route::get('/{benefit}/edit', [BenefitController::class, 'edit'])->name('edit');
            Route::match(['put', 'patch'], '/{benefit}', [BenefitController::class, 'update'])->name('update');
            Route::delete('/{benefit}', [BenefitController::class, 'destroy'])->name('destroy');
        });
    });
});
