<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\OrderStatusesController;
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

    Route::get('/order-statuses', [OrderStatusesController::class, 'all']);

    Route::get('/products', [ProductsController::class, 'all']);
    Route::get('/product/{id}', [ProductsController::class, 'one']);
    Route::put('/products', [ProductsController::class, 'create']);
    Route::post('/products/{id}', [ProductsController::class, 'update']);
    Route::delete('/products/{id}', [ProductsController::class, 'delete']);

    Route::get('/categories', [CategoriesController::class, 'all']);
    Route::put('/categories', [CategoriesController::class, 'create']);
    Route::get('/category/{id}', [CategoriesController::class, 'one']);
    Route::post('/categories/{id}', [CategoriesController::class, 'update']);
    Route::delete('/categories/{id}', [CategoriesController::class, 'delete']);

    Route::get('/orders', [OrdersController::class, 'all']);
    Route::delete('/orders/{id}', [OrdersController::class, 'delete']);
    Route::get('/order/{id}', [OrdersController::class, 'one']);
    Route::post('/orders/{id}', [OrdersController::class, 'update']);
});
