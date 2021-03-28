<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\MarketController;
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
});
