<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;

Route::get('/', [EventController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});





//Anasayfa Tüm etkinlikler
Route::get('events/index', [EventController::class, 'index'])->name('event.index');
//Login
Route::get('login',  function(){
    return view('auth.login');
})->name('login');
//register
Route::get('register', function(){
    return view('auth.register');
})->name('register');

//Seçilen etkinliğe katılım sayfası
Route::get('join/show/{event}', [EventRegistrationController::class, 'showPage'])->name('events.showPage');
Route::post('join/register/{event}', [EventRegistrationController::class, 'register'])->name('events.register');


//Katılım Onay Takibi //participant sayfası
Route::middleware('auth')->group(function () {
    // Kullanıcının kendi başvurularını takip etmesi için
    Route::get('/myRegistrations', [EventRegistrationController::class, 'myRegistrations'])->name('myRegistrations');
    //Başvurusunu iptal etmesi için
    Route::post('/myRegistrationCancel/{myRegistrations}', [EventRegistrationController::class, 'myRegistrationCancel'])->name('myRegistrationCancel');
});



//Admin Dashboard
Route::group(['prefix'=> 'admin'  ,  'middleware' => ['auth', 'admin']], function () {
    Route::get('/indexA',  [\App\Http\Controllers\AdminController::class, 'adminRegistrations'])
    ->name('admin.index');

    // Etkinlik silme
    Route::delete('/events/{id}', [\App\Http\Controllers\AdminController::class, 'deleteEvent'])
    ->name('admin.deleteEvent');
//User Listesi
    Route::get('/userList',  [\App\Http\Controllers\AdminController::class, 'userListPage'])
        ->name('admin.user-list-page');
//User role güncelleme
    Route::patch('/users/{user}', [\App\Http\Controllers\AdminController::class, 'updateUserRole'])
        ->name('admin.update-user-role');

    // User silme
    Route::delete('/users/{user}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])
        ->name('admin.delete-user');

});
Route::group(['prefix'=> 'organizer'  ,  'middleware' => ['auth', 'organizer' ]], function () {
    //kategori oluştur
Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'createPage'])->name('category.createPage');
Route::post('/category/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');

   //Başvuru onaylama
    Route::get('/registration', [EventRegistrationController::class, 'organizerIndex'])->name('organizer.registrations');
    Route::patch('/event-registrations/{registrations}/status', [EventRegistrationController::class, 'updateStatus'])->name('event-registrations.update-status');


    //yeni etkinlik oluştur
    Route::get('/index/event', [EventController::class, 'index'])->name('events.index');
Route::get('/events/createPage', [EventController::class, 'createPage'])->name('events.createPage');
Route::post('/create', [EventController::class, 'create'])->name('events.create');

});
