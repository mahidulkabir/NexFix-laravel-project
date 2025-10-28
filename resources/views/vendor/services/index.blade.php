@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2 class="mb-3">My Services</h2>
  <a href="{{ route('vendor.services.create') }}" class="btn btn-primary mb-3">+ Add Service</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Service</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($vendorServices as $vs)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $vs->service->name }}</td>
          <td>{{ number_format($vs->price, 2) }} ৳</td>
          <td><span class="badge bg-{{ $vs->status == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($vs->status) }}</span></td>
          <td>
            <a href="{{ route('vendor.services.edit', $vs->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('vendor.services.destroy', $vs->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center">No services yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
