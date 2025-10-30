<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;

// ============================
// Public Routes
// ============================
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/service/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/categories', [ServiceCategoryController::class, 'index'])->name('categories.index');

// ============================
// Authenticated User Routes
// ============================
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard (generic for all roles)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // ============================
    // CUSTOMER ROUTES
    // ============================
    Route::middleware('role:customer')->prefix('customer')->group(function () {

        // Bookings
        Route::get('/bookings', [BookingController::class, 'customerBookings'])->name('customer.bookings.index');
        Route::get('/bookings/create/{serviceId}', [BookingController::class, 'create'])->name('customer.bookings.create');
        Route::post('/bookings/store', [BookingController::class, 'store'])->name('customer.bookings.store');

        // Reviews
        Route::get('/reviews', [ReviewController::class, 'index'])->name('customer.reviews.index');
        Route::post('/reviews/store', [ReviewController::class, 'store'])->name('customer.reviews.store');

        // Payments (optional if customer pays directly)
        Route::post('/payments', [PaymentController::class, 'store'])->name('customer.payments.store');
    });

    // ============================
    // VENDOR ROUTES
    // ============================
    Route::middleware('role:vendor')->prefix('vendor')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'vendor'])->name('vendor.dashboard');

        // Profile
        Route::get('/profile', [VendorController::class, 'index'])->name('vendor.profile');
        Route::post('/profile/update', [VendorController::class, 'update'])->name('vendor.profile.update');

        // Vendor Services (vendor ↔ service pivot)
        Route::get('/services', [VendorServiceController::class, 'index'])->name('vendor.services.index');
        Route::get('/services/create', [VendorServiceController::class, 'create'])->name('vendor.services.create');
        Route::post('/services/store', [VendorServiceController::class, 'store'])->name('vendor.services.store');

        // Vendor Bookings
        Route::get('/bookings', [BookingController::class, 'vendorBookings'])->name('vendor.bookings.index');
    });

    // ============================
    // ADMIN ROUTES
    // ============================
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        // Manage Categories and Services
        Route::resource('/categories', ServiceCategoryController::class);
        Route::resource('/services', ServiceController::class);
    });
});

// ============================
// Auth routes
// ============================
require __DIR__ . '/auth.php';
