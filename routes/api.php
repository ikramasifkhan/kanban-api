<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1/todos')->group(function () {
    Route::get('initial', [\App\Http\Controllers\Api\TodoController::class, 'getInitialList']);
    Route::get('in-progress', [\App\Http\Controllers\Api\TodoController::class, 'getInProgressList']);
    Route::get('done', [\App\Http\Controllers\Api\TodoController::class, 'getDoneList']);
    Route::post('store', [\App\Http\Controllers\Api\TodoController::class, 'store']);
    Route::put('change-status', [\App\Http\Controllers\Api\TodoController::class, 'changeStatus']);
});
