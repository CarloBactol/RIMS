<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProccessController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\BarangayLGUController;
use App\Http\Controllers\BusinessPermitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth', 'log.user.activity'])->prefix('admin')->group(function () {
    // Route::resource('residents', ResidentController::class);

    Route::get('/search', [SearchController::class, 'search'])->name('search.index');
    Route::post('/person/{id}/confirm-delete', [SearchController::class, 'delete'])->name('residents.confirm-delete');
    Route::resource('business_permits', BusinessPermitController::class)->except('show');
    Route::resource('baranagay_l_g_u_s', BarangayLGUController::class)->except('show');
    Route::get('/autosuggest', [ProccessController::class, 'index'])->name('autosuggest');

    Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
    Route::get('/persons/{id}/show', [PersonController::class, 'show'])->name('persons.show');
    Route::get('/persons/{id}/edit', [PersonController::class, 'edit'])->name('persons.edit');
    Route::put('/persons/{id}/update', [PersonController::class, 'update'])->name('persons.update');
    Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
    Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');
    Route::delete('/persons/{id}', [PersonController::class, 'destroy'])->name('persons.destroy');


    Route::get('/trackings', [TrackingController::class, 'index'])->name('trackings.index');
});
