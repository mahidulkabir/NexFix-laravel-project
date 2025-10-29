<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('home');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/service/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/categories', [ServiceCategoryController::class, 'index'])->name('categories.index');


// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // Customer routes
    Route::middleware('role:customer')->group(function () {
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::get('/bookings/create/{serviceId}', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
        Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
    });
    
    // Vendor routes
    Route::middleware('role:vendor')->group(function () {
        Route::get('/vendor/dashboard', [DashboardController::class, 'vendor'])->name('vendor.dashboard');
        Route::resource('/vendor/services', VendorController::class);
        Route::get('/vendor/bookings', [BookingController::class, 'vendorBookings'])->name('vendor.bookings');
    });

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::resource('/admin/categories', ServiceCategoryController::class);
        Route::resource('/admin/services', ServiceController::class);
    });
});



require __DIR__.'/auth.php';
