@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Service Categories</h2>
  <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">+ Add Category</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($categories as $cat)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $cat->name }}</td>
          <td>{{ Str::limit($cat->description, 50) }}</td>
          <td><img src="{{ asset('storage/'.$cat->image) }}" width="60"></td>
          <td>
            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center">No categories found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
