<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LespakkettenController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// Contact message routes for owners
Route::middleware(['auth'])->group(function () {
    Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profiel', [ProfileController::class, 'show'])->name('profile.show');
});

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

// Lesson package routes
Route::get('/lespakketten', [LespakkettenController::class, 'index'])->name('lespakketten.index');

// Admin routes for lesson packages
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/lespakketten', LespakkettenController::class)->except(['index']);
});


