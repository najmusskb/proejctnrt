<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        return view('admin.category', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $cat = new Category();
        $cat->name = $request->name;
        $cat->slug = Str::slug($request->name);
        $cat->icon = $request->icon;
        $cat->section = $request->section;
        $cat->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/category'), $imageName);
            $cat->image = 'uploads/category/' . $imageName;
        }

        $cat->save();
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $categoryData = Category::findOrFail($id);
        $category = Category::latest()->get();
        return view('admin.category', compact('categoryData', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $cat = Category::findOrFail($id);
        $cat->name = $request->name;
        $cat->slug = Str::slug($request->name);
        $cat->icon = $request->icon;
        $cat->section = $request->section;
        $cat->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            if ($cat->image && file_exists(public_path($cat->image))) {
                unlink(public_path($cat->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/category'), $imageName);
            $cat->image = 'uploads/category/' . $imageName;
        }

        $cat->save();
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function delete(Request $request)
    {
        $cat = Category::findOrFail($request->id);
        if ($cat->image && file_exists(public_path($cat->image))) {
            unlink(public_path($cat->image));
        }
        $cat->delete();
        return response()->json(['success' => 'Deleted successfully']);
    }
}
