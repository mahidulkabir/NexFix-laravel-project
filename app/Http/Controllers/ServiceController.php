<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {   
        $query =Service::with('category')->where('active',true);
        if($request->has('category')){
            $query->where('category_id',$request->input('category'));
        }
        if ($request->has('search')){
            $query->where('name','like',"%{$request->search}%");
        }

        $services = $query->paginate(9);
        $categories = ServiceCategory::all();
        return view('services.index', compact('services','categories'));
    }

    public function show($id)
    {
        $service = Service::with('category', 'vendorServices.vendor.user')->findOrFail($id);
        return view('services.show', compact('service'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:service_categories,id',
        ]);
        Service::create($request->only('name', 'description', 'category_id', 'base_price', 'image', 'active'));
        return back()->with('success', 'Service added successfully');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::all();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($request->only('name', 'description', 'category_id', 'base_price', 'image', 'active'));
        return back()->with('success', 'Service updated');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service removed');
    }
}
