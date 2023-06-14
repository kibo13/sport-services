<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('orders')->as('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/create', [OrderController::class, 'create'])->name('create');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
    Route::match(['put', 'patch'], '/{order}', [OrderController::class, 'update'])->name('update');
});
