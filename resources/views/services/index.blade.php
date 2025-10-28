@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Available Services</h2>

  <div class="row">
    @forelse($services as $service)
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="{{ asset('storage/'.$service->image) }}" class="card-img-top" alt="{{ $service->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $service->name }}</h5>
            <p class="card-text">{{ Str::limit($service->description, 80) }}</p>
            <p><strong>From:</strong> {{ number_format($service->base_price,2) }} ৳</p>
            <a href="{{ route('bookings.create', $service->id) }}" class="btn btn-primary w-100">Book Now</a>
          </div>
        </div>
      </div>
    @empty
      <p>No services available right now.</p>
    @endforelse
  </div>
</div>
@endsection
