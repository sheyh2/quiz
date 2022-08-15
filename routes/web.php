<?php

use App\Http\Controllers\Web\Science\FileController;
use App\Http\Controllers\Web\Science\ScienceController;
use App\Http\Controllers\Web\Science\AnswerController;
use App\Http\Controllers\Web\TestController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function () {
    //
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('science')->group(function (Router $router) {
    $router->get('index', [ScienceController::class, 'index'])->name('science.index');
    $router->get('create', [ScienceController::class, 'create'])->name('science.create');
    $router->put('store', [ScienceController::class, 'store'])->name('science.store');


    Route::prefix('{slug}/file')->group(function (Router $router) {
        $router->get('index', [FileController::class, 'index'])->name('science.file.index');
        $router->get('create', [FileController::class, 'create'])->name('science.file.create');
        $router->post('store', [FileController::class, 'store'])->name('science.file.store');
    });


    Route::prefix('test')->group(function (Router $router) {
        $router->get('index', [TestController::class, 'index'])->name('science.test.index');
        $router->get('create', [TestController::class, 'create'])->name('science.test.create');
        $router->put('store', [TestController::class, 'store'])->name('science.test.store');

        $router->get('question', [TestController::class, 'question'])->name('science.test.question');

        Route::prefix('answer')->group(function (Router $router) {
            $router->get('index', [AnswerController::class, 'index'])->name('science.test.answer.index');
            $router->put('store', [AnswerController::class, 'store'])->name('science.test.answer.store');
        });
    });
});