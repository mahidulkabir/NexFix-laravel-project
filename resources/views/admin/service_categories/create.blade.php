@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Add New Category</h2>

  <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Save Category</button>
  </form>
</div>
@endsection
