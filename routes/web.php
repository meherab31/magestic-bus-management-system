<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard') // Redirect to dashboard if authenticated
        : view('auth.login');           // Show login page if not authenticated
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //bus
    Route::get('/buses', [BusController::class, 'index'])->name('buses.index');
    Route::post('/buses', [BusController::class, 'store'])->name('buses.store');
    Route::put('/buses/{id}', [BusController::class, 'update'])->name('buses.update');
    Route::delete('/buses/{id}', [BusController::class, 'destroy'])->name('buses.destroy');

    //routes

    Route::resource('routes', RouteController::class);

    //schedules
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    //Employee
    Route::resource('employees', EmployeeController::class);

    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/bookings/{schedule}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/post/{schedule}', [BookingController::class, 'store'])->name('bookings.store');






});
