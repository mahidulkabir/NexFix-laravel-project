@extends('layouts.vendor')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fa fa-briefcase"></i> My Services</h3>
        <a href="{{ route('vendor.services.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Service</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendorServices as $vs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vs->name }}</td>
                        <td>{{ $vs->category->name ?? '—' }}</td>
                        <td>{{ number_format($vs->pivot->price, 2) }} ৳</td>
                        <td>
                            @if($vs->pivot->active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('vendor.services.toggle', $vs->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-warning">
                                    <i class="fa fa-sync"></i>
                                </button>
                            </form>

                            <form action="{{ route('vendor.services.destroy', $vs->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Remove this service?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
