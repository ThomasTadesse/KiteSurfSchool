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
})->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Klant (customer) protected routes
Route::middleware(['auth', 'role.klant'])->group(function () {
    Route::get('/profiel', function () {
        return view('profiel');
    });
    
    Route::get('/reserveringen', function () {
        return view('reserveringen');
    });
});

// Instructeur protected routes
Route::middleware(['auth', 'role.instructeur'])->group(function () {
    Route::get('/lesrooster', function () {
        return view('lesrooster');
    });
    
    Route::get('/mijn-studenten', function () {
        return view('mijn-studenten');
    });
});

// Eigenaar protected routes
Route::middleware(['auth', 'role.eigenaar'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::get('/beheer/gebruikers', function () {
        return view('beheer.gebruikers');
    });
    
    Route::get('/beheer/inkomsten', function () {
        return view('beheer.inkomsten');
    });
});
