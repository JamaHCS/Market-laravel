<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\MarketController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\StatisticController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('statistics')->group(function () {
        Route::get('market/{market}', [StatisticController::class, 'market'])->name('gettingMarket');
        Route::get('sold-products/{market}', [StatisticController::class, 'soldProducts'])->name('soldProducts');
    });

    Route::prefix('markets')->group(function () {
        Route::post('basic-config', [MarketController::class, 'updateBasic']);
        Route::post('location-config', [MarketController::class, 'updateLocation']);
        Route::get('barcode/{barcode}', [MarketController::class, 'gettingProduct']);
    });

    Route::post('product', [SearchController::class, 'search'])->name('search');
    Route::get('products/{market}', [SearchController::class, 'products'])->name('products');

    route::post('login', [AuthController::class, 'login'])->name('api.v1.login');
    route::post('register', [AuthController::class, 'register'])->name('api.v1.register');
    route::middleware('auth:api')->post('logout', [AuthController::class, 'logout'])->name('api.v1.logout');
    route::middleware('auth:api')->get('user', [AuthController::class, 'user'])->name('api.v1.user');
});
