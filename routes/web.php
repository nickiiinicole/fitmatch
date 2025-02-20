<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CoachController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
// Rutas protegidas
//Con esto, cualquier ruta que pongas dentro de ese group estará protegida por tu middleware auth (requiere inicio de sesión) y por admin (requiere ser administrador).
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('coaches', CoachController::class);
    Route::resource('classes', ClassController::class);
});

Route::resource('reservations', ReservationController::class);