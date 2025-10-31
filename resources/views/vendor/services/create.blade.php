@extends('layouts.vendor')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5><i class="fa fa-plus"></i> Add a Service</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('vendor.services.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Service <span class="text-danger">*</span></label>
                    <select name="service_id" class="form-select" required>
                        <option value="">-- Select --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Your Price (৳)</label>
                    <input type="number" name="price" class="form-control" min="0" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                <a href="{{ route('vendor.services.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
