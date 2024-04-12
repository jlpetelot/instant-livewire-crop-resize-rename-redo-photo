<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

/* Adding the route for the photo */
Route::get('photo', [PhotoController::class, 'index'])->name('photo');
/* Adding the route for the photo */

require __DIR__.'/auth.php';
