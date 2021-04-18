<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SellController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\MarketController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\EmployeesController;
use App\Http\Controllers\Api\StatisticController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['consults'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('statistics')->group(function () {
            Route::get('market/{market}', [StatisticController::class, 'market'])->name('gettingMarket');
            Route::get('sold-products/{market}', [StatisticController::class, 'soldProducts'])->name('soldProducts');
        });

        Route::prefix('markets')->group(function () {
            Route::get('/{email}', [MarketController::class, 'index']);
            Route::post('basic-config', [MarketController::class, 'updateBasic']);
            Route::post('location-config', [MarketController::class, 'updateLocation']);
            Route::get('barcode/{barcode}', [MarketController::class, 'gettingProduct']);
        });

        Route::post('product', [SearchController::class, 'search'])->name('search');
        Route::get('products/{market}', [SearchController::class, 'products'])->name('products');

        Route::post('login', [AuthController::class, 'login'])->name('api.v1.login');
        Route::post('register', [AuthController::class, 'register'])->name('api.v1.register');
        Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout'])->name('api.v1.logout');
        Route::middleware('auth:api')->get('user', [AuthController::class, 'user'])->name('api.v1.user');

        Route::get('products', [ProductController::class, 'products'])->name('api.v1.products');

        Route::post('sell', [SellController::class, 'sell'])->name('api.v1.sell');
        Route::get('sell/index/{market}', [SellController::class, 'index'])->name('api.v1.sell.index');

        Route::get('employees/store/{uuid}', [EmployeesController::class, 'adding'])->name('api.v1.employee.store');
    });
});
