<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\NewsController;

// Public routes (accessible without authentication)
Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/dashboard')->middleware('auth');



// Social login routes
Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.login');
Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback');

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
   
    // Dashboard
    Route::get('/dashboard', action: [NewsController::class, 'dashboard'])->name('dashboard');
    
    // Category news
    Route::get('/news/{category}', [NewsController::class, 'index'])
        ->name('news.category')
        ->where('category', 'general|business|entertainment|health|science|sports|technology');
      

    Route::resource('sources', SourceController::class);
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes (login, register, etc.)
require __DIR__.'/auth.php';