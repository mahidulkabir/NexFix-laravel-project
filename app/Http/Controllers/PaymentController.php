<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:bkash,nagad,card,cash',
        ]);

        Payment::create([
            'booking_id' => $request->booking_id,
            'amount' => $request->amount,
            'method' => $request->method,
            'status' => 'success',
            'transaction_id' => uniqid('TXN-'),
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->update(['payment_status' => 'paid']);

        return back()->with('success', 'Payment successful');
    }

    public function index()
    {
        $payments = Payment::with('booking')->latest()->get();
        return view('payments.index', compact('payments'));
    }
}
