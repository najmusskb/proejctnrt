<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('sort_order')->get();
        return view('admin.package', compact('packages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:150',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp',
            'price' => 'nullable|numeric',
        ]);

        $pkg = new Package();
        $pkg->name        = $request->name;
        $pkg->subtitle    = $request->subtitle;
        $pkg->badge_label = $request->badge_label;
        $pkg->badge_icon  = $request->badge_icon;
        $pkg->price       = $request->price;
        $pkg->highlights  = $request->highlights ? array_filter(array_map('trim', explode(',', $request->highlights))) : [];
        $pkg->is_active   = $request->is_active ?? 1;
        $pkg->sort_order  = $request->sort_order ?? 0;
        $pkg->image       = $this->imageUpload($request, 'image', 'uploads/package');
        $pkg->save();

        return redirect()->back()->with(['message' => 'Package Added!', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $packages = Package::orderBy('sort_order')->get();
        $packageData = Package::findOrFail($id);
        return view('admin.package', compact('packages', 'packageData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required|max:150',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
            'price' => 'nullable|numeric',
        ]);

        $pkg = Package::findOrFail($id);
        $pkg->name        = $request->name;
        $pkg->subtitle    = $request->subtitle;
        $pkg->badge_label = $request->badge_label;
        $pkg->badge_icon  = $request->badge_icon;
        $pkg->price       = $request->price;
        $pkg->highlights  = $request->highlights ? array_filter(array_map('trim', explode(',', $request->highlights))) : [];
        $pkg->is_active   = $request->is_active ?? 1;
        $pkg->sort_order  = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            if (!empty($pkg->image) && file_exists($pkg->image)) unlink($pkg->image);
            $pkg->image = $this->imageUpload($request, 'image', 'uploads/package');
        }
        $pkg->save();

        return redirect()->route('package.index')->with(['message' => 'Package Updated!', 'alert-type' => 'success']);
    }

    public function destroy(Request $request)
    {
        $pkg = Package::find($request->id);
        if ($pkg) {
            if (!empty($pkg->image) && file_exists($pkg->image)) unlink($pkg->image);
            $pkg->delete();
        }
        return response()->json(['message' => 'Deleted Successfully', 'success' => true]);
    }
}
