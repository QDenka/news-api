<?php

use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
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

Route::prefix('v1')->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'get'])->name('news.get');
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/{news}/like', [NewsController::class, 'toggleLike'])->name('news.like');
        });
    });
});

// Auth routes
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth:sanctum')->name('logout');

Route::post('register', [RegisterController::class, 'register'])->name('register');
