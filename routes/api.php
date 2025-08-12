<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CalendarController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:api')->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('calendar', CalendarController::class);

    // Actions spécifiques calendrier
    Route::post('calendrier/block',   [CalendrierController::class, 'block']);
    Route::post('calendrier/unblock', [CalendrierController::class, 'unblock']);
});

Route::get('post', [PostController::class, 'index'])->name('posts.index');
Route::post('post', [PostController::class, 'store'])->name('posts.store');
