@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>My Bookings</h2>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Service</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($bookings as $booking)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $booking->customer->name ?? 'N/A' }}</td>
          <td>{{ $booking->vendorService->service->name ?? 'N/A' }}</td>
          <td>{{ $booking->booking_date->format('d M, Y') }}</td>
          <td><span class="badge bg-info text-dark">{{ ucfirst($booking->status) }}</span></td>
          <td>
            <form action="{{ route('vendor.bookings.updateStatus', $booking->id) }}" method="POST" class="d-inline">
              @csrf
              @method('PUT')
              <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                <option value="pending" {{ $booking->status=='pending'?'selected':'' }}>Pending</option>
                <option value="confirmed" {{ $booking->status=='confirmed'?'selected':'' }}>Confirmed</option>
                <option value="in_progress" {{ $booking->status=='in_progress'?'selected':'' }}>In Progress</option>
                <option value="completed" {{ $booking->status=='completed'?'selected':'' }}>Completed</option>
              </select>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center">No bookings found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
