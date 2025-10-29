@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-3">Book Service</h3>
  <form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="service_id" value="{{ $serviceId }}">

    <div class="mb-3">
      <label for="vendor_service_id" class="form-label">Select Vendor</label>
      <select name="vendor_service_id" id="vendor_service_id" class="form-select" required>
        <option value="">Choose Vendor</option>
        @foreach($vendors as $v)
          <option value="{{ $v->id }}">{{ $v->vendor->company_name }} — {{ number_format($v->price, 2) }} ৳</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="booking_date" class="form-label">Date</label>
      <input type="date" name="booking_date" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Service Address</label>
      <textarea name="address" class="form-control" rows="2" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Confirm Booking</button>
  </form>
</div>
@endsection
