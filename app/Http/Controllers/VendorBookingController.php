<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class VendorBookingController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor;

        $bookings = Booking::with(['vendorService.service', 'customer'])
            ->whereHas('vendorService', fn($q) => $q->where('vendor_id', $vendor->id))
            ->latest()
            ->get();

        return view('vendor.bookings.index', compact('bookings'));
    }
}
