<?php

use App\Http\Controllers\AuthController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (Router $router) {
    $router->post('sign-in', [AuthController::class, 'signIn']);
    $router->post('sign-up', [AuthController::class, 'signUp']);
});

Route::middleware('api.auth')->get('/', function () {
});
