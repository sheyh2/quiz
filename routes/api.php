<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\AuthController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (Router $router) {
    $router->post('sign-in', [AuthController::class, 'signIn']);
    $router->post('sign-up', [AuthController::class, 'signUp']);
});

Route::middleware('api.auth')->group(function () {
    Route::prefix('course')->group(function (Router $router) {
        $router->get('get-list', [CourseController::class, 'getList']);
        $router->get('show/{id}', [CourseController::class, 'show']);

        $router->put('update/{id}', [CourseController::class, 'update']);
        $router->post('activity-toggle/{id}', [CourseController::class, 'activityToggle']);

        $router->post('store', [CourseController::class, 'store']);
        $router->post('destroy', [CourseController::class, 'destroy']);
    });

    Route::prefix('lesson')->group(function (Router $router) {
        $router->get('get-list', [LessonController::class, 'getList']);
        $router->get('show/{id}', [LessonController::class, 'show']);

        $router->put('update/{id}', [LessonController::class, 'update']);
        $router->post('activity-toggle/{id}', [LessonController::class, 'activityToggle']);

        $router->post('store', [LessonController::class, 'store']);
        $router->delete('destroy/{id}', [LessonController::class, 'destroy']);
    });

    Route::prefix('file')->group(function (Router $router) {
        $router->get('get-list', [FileController::class, 'getList']);
        $router->post('store', [FileController::class, 'store']);
        $router->delete('destroy/{id}', [FileController::class, 'destroy']);
    });

    Route::prefix('quiz')->group(function (Router $router) {
        $router->get('get-list', [QuizController::class, 'getList']);
        $router->get('show/{id}', [QuizController::class, 'show']);

        $router->put('update/{id}', [QuizController::class, 'update']);
        $router->post('activity-toggle/{id}', [QuizController::class, 'activityToggle']);

        $router->post('store', [QuizController::class, 'store']);
        $router->post('destroy', [QuizController::class, 'destroy']);
    });
});
