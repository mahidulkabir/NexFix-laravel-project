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
        $stats = [
            'users' => User::count(),
            'bookings' => Booking::count(),
            'totalPayments' => Payment::sum('amount'),  
            'vendors' => Vendor::count(),
            'services' => Service::count(),
           
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
