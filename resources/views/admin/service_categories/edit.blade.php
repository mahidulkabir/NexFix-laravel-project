@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Edit Category</h2>

  <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control">{{ $category->description }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" class="form-control">
      @if($category->image)
        <img src="{{ asset('storage/'.$category->image) }}" width="80" class="mt-2">
      @endif
    </div>

    <button type="submit" class="btn btn-success">Update Category</button>
  </form>
</div>
@endsection
