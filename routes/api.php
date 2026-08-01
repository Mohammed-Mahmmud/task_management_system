<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('api.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/projects/statuses', [ProjectController::class, 'statuses']);

        Route::prefix('tasks')->controller(TaskController::class)->group(function () {
            Route::get('statuses', 'statuses');
            Route::get('priorities', 'priorities');
        });
        
        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('projects.tasks', TaskController::class)->shallow();
    });
});
