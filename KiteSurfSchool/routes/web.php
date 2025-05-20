<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PasswordResetLinkController;

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', [ContactController::class, 'show']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Add profile route
Route::get('/profiel', function () {
    return view('profiel');
})->middleware('auth')->name('profile');

// Add activation route
Route::get('/activate/{token}', [AuthController::class, 'activateAccount'])->name('activation');

// Fix the password reset routes
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

// You'll also need these routes for the password reset functionality to work completely
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function () {
    // This will be handled later when we implement the reset password functionality
})->middleware('guest')->name('password.update');
