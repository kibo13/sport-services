<?php

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
    // Подключаем файл маршрутов sections.php
    include_once __DIR__ . '/admin/sections.php';

    // Подключаем файл маршрутов users.php
    include_once __DIR__ . '/admin/users.php';

    // Подключаем файл маршрутов catalog.php
    include_once __DIR__ . '/admin/catalog.php';
});
