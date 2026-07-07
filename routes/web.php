<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/bookings/{booking}/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::delete('/room-images/{image}', [RoomController::class, 'destroyImage'])->name('room-images.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Master data - semua role bisa akses, tapi CRUD dibatasi di controller (read-only untuk petugas)
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('facilities', FacilityController::class);

    // Operasional - admin & petugas full akses
    Route::resource('guests', GuestController::class);
    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/{booking}/checkin', [BookingController::class, 'checkin'])->name('bookings.checkin');
    Route::post('/bookings/{booking}/checkout', [BookingController::class, 'checkout'])->name('bookings.checkout');
    Route::get('/bookings/{booking}/qrcode', [BookingController::class, 'qrcode'])->name('bookings.qrcode');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
    Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
});

    Route::get('/verify-booking/{code}', [BookingController::class, 'verify'])->name('bookings.verify');

    Route::middleware(['auth'])->group(function () {
        
    });
require __DIR__.'/auth.php';