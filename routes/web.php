<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\NewsController;

// Public routes (accessible to everyone)
Route::get('/', [NewsController::class, 'welcome'])->name('welcome');
Route::get('/dashboard', [NewsController::class, 'dashboard'])->name('dashboard');
Route::get('/news/{category}', [NewsController::class, 'index'])
    ->name('news.category')
    ->where('category', 'general|business|entertainment|health|science|sports|technology');

// Social login routes (optional, if you're using social authentication)
Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.login');
Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback');

// Protected profile routes (only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes (login, register, etc.)
require __DIR__.'/auth.php';