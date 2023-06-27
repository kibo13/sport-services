<?php


use App\Http\Controllers\Admin\BenefitController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\MethodController;
use App\Http\Controllers\Admin\SpecializationController;
use Illuminate\Support\Facades\Route;

Route::prefix('catalog')->group(function () {
    // Льготники
    Route::prefix('benefits')->as('benefits.')->group(function () {
        Route::middleware('permission:benefit_read')->group(function () {
            Route::get('/', [BenefitController::class, 'index'])->name('index');
        });
        Route::middleware('permission:benefit_full')->group(function () {
            Route::get('/create', [BenefitController::class, 'create'])->name('create');
            Route::post('/', [BenefitController::class, 'store'])->name('store');
            Route::get('/{benefit}/edit', [BenefitController::class, 'edit'])->name('edit');
            Route::match(['put', 'patch'], '/{benefit}', [BenefitController::class, 'update'])->name('update');
            Route::delete('/{benefit}', [BenefitController::class, 'destroy'])->name('destroy');
        });
    });

    // Методики
    Route::prefix('methods')->as('methods.')->group(function () {
        Route::middleware('permission:method_read')->group(function () {
            Route::get('/', [MethodController::class, 'index'])->name('index');
        });
        Route::middleware('permission:method_full')->group(function () {
            Route::get('/create', [MethodController::class, 'create'])->name('create');
            Route::post('/', [MethodController::class, 'store'])->name('store');
            Route::get('/{method}/edit', [MethodController::class, 'edit'])->name('edit');
            Route::match(['put', 'patch'], '/{method}', [MethodController::class, 'update'])->name('update');
            Route::delete('/{method}', [MethodController::class, 'destroy'])->name('destroy');
        });
    });

    // Образования
    Route::prefix('educations')->as('educations.')->group(function () {
        Route::middleware('permission:education_read')->group(function () {
            Route::get('/', [EducationController::class, 'index'])->name('index');
        });
        Route::middleware('permission:education_full')->group(function () {
            Route::get('/create', [EducationController::class, 'create'])->name('create');
            Route::post('/', [EducationController::class, 'store'])->name('store');
            Route::get('/{education}/edit', [EducationController::class, 'edit'])->name('edit');
            Route::match(['put', 'patch'], '/{education}', [EducationController::class, 'update'])->name('update');
            Route::delete('/{education}', [EducationController::class, 'destroy'])->name('destroy');
        });
    });

    // Специализации
    Route::prefix('specializations')->as('specializations.')->group(function () {
        Route::middleware('permission:specialization_read')->group(function () {
            Route::get('/', [SpecializationController::class, 'index'])->name('index');
        });
        Route::middleware('permission:specialization_full')->group(function () {
            Route::get('/create', [SpecializationController::class, 'create'])->name('create');
            Route::post('/', [SpecializationController::class, 'store'])->name('store');
            Route::get('/{specialization}/edit', [SpecializationController::class, 'edit'])->name('edit');
            Route::match(['put', 'patch'], '/{specialization}', [SpecializationController::class, 'update'])->name('update');
            Route::delete('/{specialization}', [SpecializationController::class, 'destroy'])->name('destroy');
        });
    });
});
