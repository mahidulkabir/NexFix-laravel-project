@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">My Reviews</h2>

  <div class="mb-4">
    <form method="POST" action="{{ route('reviews.store') }}">
      @csrf
      <div class="mb-3">
        <label for="booking_id" class="form-label">Booking</label>
        <select name="booking_id" id="booking_id" class="form-select" required>
          <option value="">Select a booking</option>
          @foreach($bookings as $booking)
            <option value="{{ $booking->id }}">{{ $booking->vendorService->service->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="rating" class="form-label">Rating (1–5)</label>
        <input type="number" name="rating" id="rating" min="1" max="5" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
      </div>

      <button type="submit" class="btn btn-success">Submit Review</button>
    </form>
  </div>

  <hr>

  <div class="mt-4">
    @forelse($reviews as $review)
      <div class="border rounded p-3 mb-3">
        <h5>{{ $review->vendor->company_name ?? 'Vendor' }}</h5>
        <p class="mb-1">⭐ {{ $review->rating }}/5</p>
        <p>{{ $review->comment }}</p>
        <small class="text-muted">Reviewed on {{ $review->created_at->format('d M Y') }}</small>
      </div>
    @empty
      <p>No reviews yet.</p>
    @endforelse
  </div>
</div>
@endsection
