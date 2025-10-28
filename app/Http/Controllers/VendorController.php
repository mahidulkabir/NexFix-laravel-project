<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor;
        $vendorServices = $vendor->vendorServices()->with('service')->get();
        return view('vendor.services.index', compact('vendorServices'));
    }

    public function create()
    {
        $services = Service::all();
        return view('vendor.services.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
        ]);

        $vendor = Auth::user()->vendor;
        $vendor->vendorServices()->create([
            'service_id' => $request->service_id,
            'price' => $request->price,
        ]);

        return back()->with('success', 'Service added successfully');
    }

    public function edit($id)
    {
        $vendorService = Auth::user()->vendor->vendorServices()->findOrFail($id);
        return view('vendor.services.edit', compact('vendorService'));
    }

    public function update(Request $request, $id)
    {
        $vendorService = Auth::user()->vendor->vendorServices()->findOrFail($id);
        $vendorService->update($request->only('price', 'status'));
        return back()->with('success', 'Service updated');
    }

    public function destroy($id)
    {
        $vendorService = Auth::user()->vendor->vendorServices()->findOrFail($id);
        $vendorService->delete();
        return back()->with('success', 'Service removed');
    }
}
