@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Services</h2>
  <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">+ Add Service</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Category</th>
        <th>Base Price</th>
        <th>Active</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($services as $srv)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $srv->name }}</td>
          <td>{{ $srv->category->name ?? 'N/A' }}</td>
          <td>{{ number_format($srv->base_price,2) }}</td>
          <td><span class="badge bg-{{ $srv->active ? 'success':'secondary' }}">{{ $srv->active ? 'Yes' : 'No' }}</span></td>
          <td>
            <a href="{{ route('admin.services.edit', $srv->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.services.destroy', $srv->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center">No services found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
