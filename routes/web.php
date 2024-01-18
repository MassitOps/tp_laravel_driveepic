<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [CarController::class, 'home']);
Route::get('/home', [CarController::class, 'home']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('cars', CarController::class);

Route::get('/cars/{car}/rent', [CarController::class, 'rent'])->name('cars.rent');

Route::middleware(['auth'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
});
Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/cars/{car}/users', [CarController::class, 'showUsers'])->name('cars.show_users');
