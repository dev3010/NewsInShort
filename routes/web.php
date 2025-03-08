<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\TestMiddleware;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Controllers\NewsController;

// Welcome page
Route::get('/', [NewsController::class, 'welcome'])->name('home');

// Dashboard page
Route::get('/dashboard', [NewsController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Category news (public route)
Route::get('/news/{category}', [NewsController::class, 'index'])
    ->name('news.category')
    ->where('category', 'general|business|entertainment|health|science|sports|technology');



Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.login');

Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback');


Route::get('/test', function () {
    return 'Test route';
})->middleware(TestMiddleware::class);


Route::prefix('admin')->middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
