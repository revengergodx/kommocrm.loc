<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('contacts/', [ContactController::class, 'index']);

Route::prefix('tasks')->controller(TaskController::class)->group(function () {
    Route::get('/', 'index');
    Route::POST('/', 'store');
    Route::get('/create', 'create');
    Route::post('create', 'store');
    Route::get('/{id}', 'show');
});

//Route::controller()
