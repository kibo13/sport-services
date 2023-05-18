<?php

use App\Http\Controllers\Admin\HomeController;
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


    Route::get('/', [HomeController::class, 'index']);

});
