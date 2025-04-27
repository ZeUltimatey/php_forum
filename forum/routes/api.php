<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Thread routes
Route::get('/threads', [ThreadController::class, 'index']);
Route::post('/threads', [ThreadController::class, 'store']);
Route::get('/threads/{id}', [ThreadController::class, 'show']);
Route::put('/threads/{id}', [ThreadController::class, 'update']);
Route::delete('/threads/{id}', [ThreadController::class, 'destroy']);
