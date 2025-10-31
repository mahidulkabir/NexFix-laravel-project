@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5><i class="fa fa-edit"></i> Edit Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" width="100" class="mb-2 rounded">
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Update
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
