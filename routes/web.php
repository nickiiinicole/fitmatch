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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Rutas protegidas
//Con esto, cualquier ruta que pongas dentro de ese group estará protegida por tu middleware auth (requiere inicio de sesión) y por admin (requiere ser administrador).
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('coaches', CoachController::class);
    Route::resource('classes', ClassController::class);
    Route::get('/admin/reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations.index');

});
Route::middleware(['auth'])->group(function () {
    Route::get('reservations/create/{id}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])
    ->where('id', '[0-9]+')
    ->name('reservations.destroy');


});