@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5><i class="fa fa-edit"></i> Edit Service</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Service Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $service->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Base Price (৳)</label>
                    <input type="number" name="base_price" class="form-control" min="0" step="0.01"
                           value="{{ old('base_price', $service->base_price) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    @if($service->image)
                        <img src="{{ asset('storage/'.$service->image) }}" width="100" class="mb-2 rounded">
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="active" value="1" class="form-check-input" {{ $service->active ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Update
                </button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
