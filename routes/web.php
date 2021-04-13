<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->post('statistics/', [ProductController::class, 'soldProducts'])->name('statistics');

Route::post('password-checking', [DashboardController::class, 'checkingPassword'])->name('checkingPassword');

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

Route::prefix('markets')->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('create', [MarketController::class, 'create'])->name('market.create');
        Route::post('store', [MarketController::class, 'store'])->name('market.store');
        Route::post('config', [MarketController::class, 'config'])->name('market.config');

        Route::prefix('products')->group(function () {
            Route::post('/', [ProductController::class, 'index'])->name('market.products.show');
            Route::post('how', [ProductController::class, 'howToAdd'])->name('market.products.how');
            Route::post('/create/manual', [ProductController::class, 'manual'])->name('market.products.manual');
            Route::post('/create/automatic', [ProductController::class, 'automatic'])->name('market.products.automatic');
            Route::post('/store/manual', [ProductController::class, 'store'])->name('market.products.store');
            Route::post('/store/automatic', [ProductController::class, 'storeAutomatic'])->name('market.products.store.automatic');
            Route::post('/edit', [ProductController::class, 'edit'])->name('market.products.edit');
            Route::post('/update', [ProductController::class, 'update'])->name('market.products.update');
            Route::post('/destroy', [ProductController::class, 'destroyed'])->name('market.products.destroy');
        });
    });
});
