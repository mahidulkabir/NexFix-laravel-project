@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">My Bookings</h2>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Service</th>
        <th>Vendor</th>
        <th>Date</th>
        <th>Status</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @forelse($bookings as $booking)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $booking->vendorService->service->name ?? 'N/A' }}</td>
          <td>{{ $booking->vendorService->vendor->company_name ?? 'N/A' }}</td>
          <td>{{ $booking->booking_date->format('d M, Y') }}</td>
          <td><span class="badge bg-info text-dark">{{ ucfirst($booking->status) }}</span></td>
          <td>{{ number_format($booking->total_amount,2) }} ৳</td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center">No bookings yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
