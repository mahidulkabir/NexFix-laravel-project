@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-3">My Offered Services</h3>

  <a href="{{ route('vendor.services.create') }}" class="btn btn-success mb-3">Add New Service</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Service</th>
        <th>Price</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($vendorServices as $vs)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $vs->service->name }}</td>
          <td>{{ number_format($vs->price, 2) }} ৳</td>
          <td><span class="badge bg-info">{{ ucfirst($vs->status) }}</span></td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center">No services yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
