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







//etkinlik listesi
Route::get('/index', [EventController::class, 'index'])->name('events.index');

//Seçilen etkinliğe katılım sayfası
Route::get('join/show/{event}', [EventRegistrationController::class, 'showPage'])->name('events.showPage');
Route::post('join/register/{event}', [EventRegistrationController::class, 'register'])->name('events.register');


//Katılım Onay Sayfaları//participant sayfası
Route::middleware('auth')->group(function () {
    // Kullanıcının kendi başvurularını takip etmesi için
    Route::get('/myRegistrations', [EventRegistrationController::class, 'myRegistrations'])->name('myRegistrations');
});



//Admin Dashboard
Route::group(['prefix'=> 'admin'  ,  'middleware' => ['auth', 'admin']], function () {
    Route::get('/indexA',  [EventRegistrationController::class, 'adminRegistrations'])
    ->name('admin.index');


});
Route::group(['prefix'=> 'organizer'  ,  'middleware' => ['auth', 'organizer' ]], function () {
    //kategori oluştur
Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'createPage'])->name('category.createPage');
Route::post('/category/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');

   //Başvuru onaylama
    Route::get('/indexR', [EventRegistrationController::class, 'organizerIndex'])->name('organizer.registrations');
    Route::patch('/event-registrations/{registrations}/status', [EventRegistrationController::class, 'updateStatus'])->name('event-registrations.update-status');


    //yeni etkinlik oluştur
    Route::get('/index/event', [EventController::class, 'index'])->name('events.index');
Route::get('/events/createPage', [EventController::class, 'createPage'])->name('events.createPage');
Route::post('/create', [EventController::class, 'create'])->name('events.create');

});
