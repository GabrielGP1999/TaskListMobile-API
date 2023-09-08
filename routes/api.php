<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Task;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('/signup', [AuthController::class, 'signup']);
    Route::middleware(['cors'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/saveTask', [Task::class, 'saveTask']);
    Route::get('/getTasks', [Task::class, 'getTasks']);
    Route::post('/signup', [AuthController::class, 'signup']);
});


