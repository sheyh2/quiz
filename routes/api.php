<?php

use App\Http\Controllers\Api\CourseController;
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
        $router->post('store', [CourseController::class, 'store']);
        $router->put('update/{id}', [CourseController::class, 'update']);
    });
});
