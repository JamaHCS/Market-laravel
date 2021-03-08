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
Route::middleware(['auth:sanctum', 'verified'])->get('statistics/{market}', [ProductController::class, 'soldProducts'])->name('statistics');

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

Route::middleware(['auth:sanctum', 'verified'])->get('markets/create', [MarketController::class, 'create'])->name('market.create');
Route::middleware(['auth:sanctum', 'verified'])->post('markets/store', [MarketController::class, 'store'])->name('market.store');
