<?php

// app/Http/Controllers/AdminVendorController.php
namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminVendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::with('user')->latest()->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function approve($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Vendor approved successfully.');
    }

    public function reject($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['status' => 'rejected']);
        return redirect()->back()->with('error', 'Vendor rejected.');
    }
}

