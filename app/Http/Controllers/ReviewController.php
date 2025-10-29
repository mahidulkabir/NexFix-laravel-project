<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('customer_id', Auth::id())
            ->with('vendor.user', 'booking')
            ->latest()
            ->get();

        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'vendor_id' => 'required|exists:vendors,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);
        
        $booking = Booking::findOrFail($request->booking_id);

        Review::create([
            'booking_id' => $booking->id,
            'customer_id' => Auth::id(),
            'vendor_id' => $booking->vendorService->vendor_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted');
    }
}
