<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RuleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// auth
Auth::routes([
    'login'    => true,
    'register' => true,
    'reset'    => true,
    'confirm'  => false,
    'verify'   => false,
]);

// mai
Route::view('/mai', 'mai.index')->name('mai');

// admin
Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/me', [ProfileController::class, 'index'])->name('profile');
    Route::match(['put', 'patch'], 'me/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/rules', [RuleController::class, 'index'])->name('rules');

    // Подключаем файл маршрутов users.php
    include_once __DIR__ . '/admin/users.php';

    // Подключаем файл маршрутов catalog.php
    include_once __DIR__ . '/admin/catalog.php';

});
