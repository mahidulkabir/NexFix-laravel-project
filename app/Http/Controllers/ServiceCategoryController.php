<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        ServiceCategory::create($request->only('name', 'description', 'image'));
        return back()->with('success', 'Category created successfully');
    }

    public function edit(ServiceCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, ServiceCategory $category)
    {
        $category->update($request->only('name', 'description', 'image'));
        return back()->with('success', 'Category updated');
    }

    public function destroy(ServiceCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted');
    }
}
