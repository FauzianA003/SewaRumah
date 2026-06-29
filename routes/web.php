<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- AKSES PUBLIK (Siapa saja bisa lihat) ---
Route::redirect('/', '/login');
Route::get('/houses', [HouseController::class, 'index'])->name('houses.index');
Route::get('/houses/{id}', [HouseController::class, 'show'])->name('houses.show');

// SOLUSI 1: Alihkan rute ke view via helper Route::view (ini aman dari cache error)
Route::view('/kontak', 'kontak')->name('kontak');

// --- AKSES USER LOGIN (Wajib Login) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Bawaan Breeze
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Fitur Sewa untuk Penyewa
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');

    // --- RUTE KONFIRMASI TRANSFER BRI MANUAL ---
    Route::patch('/my-bookings/{id}/confirm', [BookingController::class, 'confirmPayment'])->name('bookings.confirm');
    Route::post('/bookings/{id}/upload', [BookingController::class, 'uploadPayment'])->name('bookings.upload');

    // SOLUSI 2: Alihkan rute ke view via helper Route::view (aman dari cache error)
    Route::view('/booking-success', 'bookings.success')->name('bookings.success');

    // --- AKSES ADMIN (Manajemen Katalog & Pesanan) ---
    // SOLUSI 3: Menggunakan 'can:' bawaan Laravel gate (Memeriksa email admin langsung tanpa closure)
    Route::middleware(['can:access-admin'])->group(function () {

        // Manajemen Rumah (Katalog)
        Route::get('/admin/houses/create', [HouseController::class, 'create'])->name('admin.houses.create');
        Route::post('/admin/houses', [HouseController::class, 'store'])->name('admin.houses.store');

        // --- RUTE EDIT & UPDATE ---
        Route::get('/admin/houses/{id}/edit', [HouseController::class, 'edit'])->name('admin.houses.edit');
        Route::put('/admin/houses/{id}', [HouseController::class, 'update'])->name('admin.houses.update');
        Route::delete('/admin/houses/{id}', [HouseController::class, 'destroy'])->name('admin.houses.destroy');

        // Manajemen Pesanan (Booking)
        Route::get('/admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::patch('/admin/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::delete('/admin/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });

    // Fitur Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
