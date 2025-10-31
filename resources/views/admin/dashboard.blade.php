@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Admin Dashboard</h2>
        <p class="text-muted">Welcome back, {{ Auth::user()->name }}</p>

        <div class="row mt-4 text-center">
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3">
                    <h6>Total Users</h6>
                    <h3>{{ $totalUsers ?? 0 }}</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3">
                    <h6>Total Vendors</h6>
                    <h3>{{ $totalVendors ?? 0 }}</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3">
                    <h6>Total Services</h6>
                    <h3>{{ $totalServices ?? 0 }}</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3">
                    <h6>Total Bookings</h6>
                    <h3>{{ $totalBookings ?? 0 }}</h3>
                </div>
            </div>
        </div>
{{-- new feature optional   --}}
        <div class="row mt-4">
        @foreach ($stats as $label => $count)
            <div class="col-md-3 mb-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize">{{ $label }}</h5>
                        <p class="card-text fs-3">{{ $count }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
@endsection
