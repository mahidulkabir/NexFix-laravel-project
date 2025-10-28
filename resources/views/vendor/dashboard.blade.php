@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Vendor Dashboard</h2>
  <p class="text-muted">Welcome, {{ Auth::user()->name }}</p>

  <div class="row text-center">
    <div class="col-md-4 mb-3">
      <div class="card p-3 shadow-sm">
        <h5>Total Services</h5>
        <h3>{{ $totalServices ?? 0 }}</h3>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3 shadow-sm">
        <h5>Total Bookings</h5>
        <h3>{{ $totalBookings ?? 0 }}</h3>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3 shadow-sm">
        <h5>Average Rating</h5>
        <h3>{{ number_format($averageRating ?? 0, 1) }}</h3>
      </div>
    </div>
  </div>
</div>
@endsection
