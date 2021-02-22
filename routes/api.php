<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\Auth\AuthenticationController;

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
    Route::post('signin', [AuthenticationController::class, 'signin']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('group', GroupController::class);
    Route::apiResource('project', ProjectController::class);
    Route::apiResource('server', ServerController::class);
    Route::apiResource('environment', EnvironmentController::class);
    Route::apiResource('variable', VariableController::class);
});
