<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
});

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
