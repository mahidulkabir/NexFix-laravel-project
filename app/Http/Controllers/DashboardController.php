<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function vendor()
    {
        $vendor = Auth::user()->vendor;
        $bookings = $vendor->bookings()->latest()->take(10)->get();
        return view('vendor.dashboard', compact('vendor', 'bookings'));
    }

    public function admin()
{
    $totalUsers = User::count();
    $activeVendors =Vendor::where('verified', true)->count();
    $totalBookings = Booking::count();

    $recentBookings = Booking::with(['customer', 'vendorService.vendor', 'vendorService.service'])
        ->latest()->take(5)->get();

    return view('admin.dashboard', compact('totalUsers', 'activeVendors', 'totalBookings', 'recentBookings'));
}
}
