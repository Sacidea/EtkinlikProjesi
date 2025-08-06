<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



// routes/web.php
Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/temp', [EventController::class, 'layout'])->name('panel.layout');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])
        ->name('events.register');
    Route::delete('/events/{event}/cancel', [EventRegistrationController::class, 'cancel'])
        ->name('events.cancel');

    Route::get('/my-registrations', [UserController::class, 'myRegistrations'])
        ->name('user.registrations');
});

// Admin route'ları
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('events', AdminEventController::class);
    Route::get('registrations', [AdminController::class, 'registrations']);
    Route::patch('registrations/{registration}', [AdminController::class, 'updateRegistration']);
});
