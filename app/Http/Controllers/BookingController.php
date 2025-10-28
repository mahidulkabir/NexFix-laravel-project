<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('customer_id', Auth::id())
            ->with('vendorService.service', 'vendorService.vendor.user')
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_service_id' => 'required|exists:vendor_services,id',
            'total_amount' => 'required|numeric|min:0',
        ]);

        Booking::create([
            'customer_id' => Auth::id(),
            'vendor_service_id' => $request->vendor_service_id,
            'booking_date' => now(),
            'status' => 'pending',
            'total_amount' => $request->total_amount,
            'address' => $request->address,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
    }

    public function vendorBookings()
    {
        $vendor = Auth::user()->vendor;
        $bookings = $vendor->bookings()->with('vendorService.service', 'customer')->latest()->get();
        return view('vendor.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);
        return back()->with('success', 'Booking status updated');
    }
}
