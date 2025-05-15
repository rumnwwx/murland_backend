<?php

use App\Http\Controllers\Cat\CatController;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Cat;
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


Route::get('/cats', [Cat\CatController::class, 'index']);
Route::post('/order', [Cat\CatController::class, 'createOrder']);
Route::post('/ordercat' , [Cat\CatController::class, 'createOrderCat']);




Route::prefix('admin')->group(function () {
    Route::post('/login', Admin\LoginController::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', Admin\LogoutController::class);
        Route::post('/create', Admin\CatController::class);
        Route::get('/cats', [Admin\CatController::class, 'allCats']);
        Route::get('/cats/{id}', [Admin\CatController::class, 'viewCat']);
        Route::patch('/cats/{id}', [Admin\CatController::class, 'updateCat']);
        Route::delete('/cats/{id}', [Admin\CatController::class, 'deleteCat']);
        Route::get('/orders', [Admin\CatController::class, 'getAllOrders']);
    });
});

