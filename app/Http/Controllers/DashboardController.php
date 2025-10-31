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
    public function customer()
{
    $user = Auth::user();

    $totalBookings = Booking::where('customer_id', $user->id)->count();
    $completedBookings = Booking::where('customer_id', $user->id)->where('status', 'completed')->count();
    $pendingBookings = Booking::where('customer_id', $user->id)->where('status', 'pending')->count();

    $recentBookings = Booking::with(['vendorService.service', 'vendorService.vendor'])
        ->where('customer_id', $user->id)
        ->latest()->take(5)->get();

    // $notifications = \App\Models\Notification::where('user_id', $user->id)
        // ->latest()->take(5)->get();

    return view('customer.dashboard', compact(
        'totalBookings',
        'completedBookings',
        'pendingBookings',
        'recentBookings',
        'notifications'
    ));
}



    public function vendor()
    {
        $vendor = Auth::user()->vendor;

        $serviceCount = $vendor->vendorServices()->count();
        $bookingCount = Booking::whereHas('vendorService', fn($q) =>
        $q->where('vendor_id', $vendor->id))->count();

        $completedBookings = Booking::whereHas('vendorService', fn($q) =>
        $q->where('vendor_id', $vendor->id))
            ->where('status', 'completed')->count();

        $recentBookings = Booking::with(['customer', 'vendorService.service'])
            ->whereHas('vendorService', fn($q) => $q->where('vendor_id', $vendor->id))
            ->latest()->take(5)->get();

        return view('vendor.dashboard', compact('serviceCount', 'bookingCount', 'completedBookings', 'recentBookings'));
    }

    public function admin()
    {
        $totalUsers = User::count();
        $activeVendors = Vendor::where('verified', true)->count();
        $totalBookings = Booking::count();

        $recentBookings = Booking::with(['customer', 'vendorService.vendor', 'vendorService.service'])
            ->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'activeVendors', 'totalBookings', 'recentBookings'));
    }
}
