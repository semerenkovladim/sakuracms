<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\ProductsController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/refresh', [AuthController::class, 'refresh']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/products', [ProductsController::class, 'all']);
    Route::get('/product/{id}', [ProductsController::class, 'one']);
    Route::put('/products', [ProductsController::class, 'create']);
    Route::post('/products/{id}', [ProductsController::class, 'update']);
    Route::get('/categories', [CategoriesController::class, 'all']);
    Route::delete('/products/{id}', [ProductsController::class, 'delete']);
});
