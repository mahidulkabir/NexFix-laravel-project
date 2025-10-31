<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorServiceController extends Controller
{
    // Show list of vendor’s assigned services
    public function index()
    {
        $vendor = Auth::user()->vendor;
        $vendorServices = $vendor->services()->with('category')->get();

        return view('vendor.services.index', compact('vendorServices'));
    }

    // Show form to attach new service
    public function create()
    {
        $services = Service::where('active', true)->get();
        return view('vendor.services.create', compact('services'));
    }

    // Store new vendor-service relation
    public function store(Request $request)
    {
        $vendor = Auth::user()->vendor;

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
        ]);

        // Attach or update pivot
        $vendor->services()->syncWithoutDetaching([
            $request->service_id => [
                'price' => $request->price,
                'active' => true,
            ]
        ]);

        return redirect()->route('vendor.services.index')->with('success', 'Service added successfully!');
    }

    // Toggle service active/inactive
    public function toggle($id)
    {
        $vendor = Auth::user()->vendor;
        $service = $vendor->services()->where('service_id', $id)->first();

        if ($service) {
            $newStatus = !$service->pivot->active;
            $vendor->services()->updateExistingPivot($id, ['active' => $newStatus]);
        }

        return back()->with('success', 'Service status updated.');
    }

    // Remove service
    public function destroy($id)
    {
        $vendor = Auth::user()->vendor;
        $vendor->services()->detach($id);

        return back()->with('success', 'Service removed successfully.');
    }
}
