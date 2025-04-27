<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('threads', ThreadController::class);
    Route::apiResource('threads.posts', PostController::class);
    Route::post('threads/{thread}/like', [ThreadController::class, 'like']);
    Route::post('threads/{thread}/follow', [ThreadController::class, 'follow']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
