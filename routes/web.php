<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('statistics/{market}', [ProductController::class, 'soldProducts'])->name('statistics');



// Route::get('/auth/facebook', function () {
//     return Socialite::driver('facebook')->redirect();
// });

// Route::get('/auth/facebook/callback', function () {
//     $user = Socialite::driver('facebook')->user();
//     // $user->token
// });

// Route::get('/auth/google', function () {
//     return Socialite::driver('facebook')->redirect();
// });

// Route::get('/auth/google/callback', function () {
//     $user = Socialite::driver('google')->user();
//     // $user->token
// });

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);
