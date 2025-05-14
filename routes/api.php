<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers;
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


Route::get('/mainpage', [User\UserController::class, 'userViewCats']);
Route::post('/mainpage', [User\UserController::class, 'createReview']);



Route::prefix('admin')->group(function () {
    Route::post('/login', Admin\LoginController::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', Admin\LogoutController::class);
        Route::post('/create', Admin\CatController::class);
        Route::get('/cat', [Admin\CatController::class, 'allCats']);
        Route::get('/cat/{id}', [Admin\CatController::class, 'viewCat']);
        Route::patch('/cat/{id}', [Admin\CatController::class, 'updateCat']);
        Route::delete('/cat/{id}', [Admin\CatController::class, 'deleteCat']);
    });
});

