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
Route::get('/temp',function(){
    return view('panel.layout.app');//her html sayfasında  bulunacak kısım(menü, navbar vs.)
});






//etkinlik listesi
Route::get('/index', [EventController::class, 'index'])->name('events.index');
//yeni etkinlik oluştur
Route::get('/events/createPage', [EventController::class, 'createPage'])->name('events.createPage');
Route::post('/create', [EventController::class, 'create'])->name('events.create');

//Seçilen etkinliğe kayıt  sayfası
Route::get('/show/{event}', [EventRegistrationController::class, 'showPage'])->name('events.showPage');
Route::post('/register/{event}', [EventRegistrationController::class, 'register'])->name('events.register');


//Organizer Onay Sayfaları
Route::middleware('auth')->group(function () {
    // Organizer için
    Route::get('/organizer/index', [EventRegistrationController::class, 'organizerIndex'])->name('organizer.registrations');
    Route::patch('/event-registrations/{registrations}/status', [EventRegistrationController::class, 'updateStatus'])->name('event-registrations.update-status');

    // Kullanıcının kendi başvuruları için
    Route::get('/myRegistrations', [EventRegistrationController::class, 'myRegistrations'])->name('myRegistrations');
});

//kategori oluştur

Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'createPage'])->name('category.createPage');
Route::post('/categoryKaydı', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');




