@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Edit Service</h2>

  <form method="POST" action="{{ route('vendor.services.update', $vendorService->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Service</label>
      <input type="text" class="form-control" value="{{ $vendorService->service->name }}" disabled>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Custom Price</label>
      <input type="number" name="price" id="price" class="form-control" value="{{ $vendorService->price }}" required>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="status" class="form-select">
        <option value="active" {{ $vendorService->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $vendorService->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Update Service</button>
  </form>
</div>
@endsection
