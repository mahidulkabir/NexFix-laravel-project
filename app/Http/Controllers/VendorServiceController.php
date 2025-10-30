<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\VendorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorServiceController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor;
        $vendorServices = VendorService::with('service')
        ->where('vendor_id', $vendor->id)
        ->get();
        return view('vendor.services.index', compact('vendorServices'));
    }

    public function create()
    {
        $services = Service::where('active', true)->get();
        return view('vendor_services.create',compact('services'));
    }
    public function store(Request $request)
    {
        $request ->validate([
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
            'status'=>'required|in:active,inactive',
        ]);
        $vendor = Auth::user()->vendor;

        VendorService::create([
            'vendor_id' => $vendor->id,
            'service_id' => $request->service_id,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('vendor.services.index')
            ->with('success','Service added successfully');
    }
}
