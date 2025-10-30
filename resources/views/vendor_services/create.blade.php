@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-3">Add Service</h3>

  <form method="POST" action="{{ route('vendor.services.store') }}">
    @csrf
    <div class="mb-3">
      <label for="service_id" class="form-label">Select Service</label>
      <select name="service_id" id="service_id" class="form-select" required>
        <option value="">Choose</option>
        @foreach($services as $s)
          <option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="number" name="price" id="price" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="status" class="form-select" required>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>
@endsection
