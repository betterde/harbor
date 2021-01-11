<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\EnvironmentController;

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

Route::prefix('auth')->group(function () {
//    Route::post('signin', []);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('project', ProjectController::class);
    Route::apiResource('environment', EnvironmentController::class);
    Route::apiResource('variable', VariableController::class);
});
