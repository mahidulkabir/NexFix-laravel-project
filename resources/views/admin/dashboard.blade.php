@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Admin Dashboard</h1>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-blue-500">
            <h2 class="text-sm text-gray-500">Total Users</h2>
            <p class="text-3xl font-semibold text-gray-800">{{ $totalUsers ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-green-500">
            <h2 class="text-sm text-gray-500">Active Vendors</h2>
            <p class="text-3xl font-semibold text-gray-800">{{ $activeVendors ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-yellow-500">
            <h2 class="text-sm text-gray-500">Total Bookings</h2>
            <p class="text-3xl font-semibold text-gray-800">{{ $totalBookings ?? 0 }}</p>
        </div>
    </div>

    {{-- Recent Bookings Table --}}
    <div class="bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Recent Bookings</h2>
        <table class="min-w-full text-sm text-gray-700 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Customer</th>
                    <th class="py-2 px-4 text-left">Service</th>
                    <th class="py-2 px-4 text-left">Vendor</th>
                    <th class="py-2 px-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings ?? [] as $booking)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $booking->id }}</td>
                        <td class="py-2 px-4">{{ $booking->customer->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4">{{ $booking->vendorService->service->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4">{{ $booking->vendorService->vendor->company_name ?? 'N/A' }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 rounded text-white
                                @if($booking->status == 'completed') bg-green-500
                                @elseif($booking->status == 'pending') bg-yellow-500
                                @else bg-gray-400 @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-4 text-center text-gray-400">No recent bookings.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
