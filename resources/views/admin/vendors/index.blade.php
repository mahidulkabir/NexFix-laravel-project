@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vendor Management</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Vendor Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td>{{ $vendor->user->name ?? 'N/A' }}</td>
                    <td>{{ $vendor->user->email ?? 'N/A' }}</td>
                    <td>
                        <span class="badge 
                            @if($vendor->status == 'approved') bg-success 
                            @elseif($vendor->status == 'rejected') bg-danger 
                            @else bg-warning text-dark @endif">
                            {{ ucfirst($vendor->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($vendor->status === 'pending')
                            <form action="{{ route('admin.vendors.approve', $vendor->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('admin.vendors.reject', $vendor->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <em>No actions</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
