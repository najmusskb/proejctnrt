<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::orderBy('sort_order')->get();
        return view('admin.destination', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $destination = new Destination();
        $destination->name = $request->name;
        $destination->slug = Str::slug($request->name);
        $destination->status = $request->status ?? 1;
        $destination->sort_order = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/destinations'), $imageName);
            $destination->image = 'uploads/destinations/' . $imageName;
        }

        $destination->save();
        return redirect()->route('destination.index')->with('success', 'Destination created successfully');
    }

    public function edit($id)
    {
        $destinationData = Destination::findOrFail($id);
        $destinations = Destination::orderBy('sort_order')->get();
        return view('admin.destination', compact('destinationData', 'destinations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $destination = Destination::findOrFail($id);
        $destination->name = $request->name;
        $destination->slug = Str::slug($request->name);
        $destination->status = $request->status ?? 1;
        $destination->sort_order = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            if ($destination->image && file_exists(public_path($destination->image))) {
                unlink(public_path($destination->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/destinations'), $imageName);
            $destination->image = 'uploads/destinations/' . $imageName;
        }

        $destination->save();
        return redirect()->route('destination.index')->with('success', 'Destination updated successfully');
    }

    public function delete(Request $request)
    {
        $destination = Destination::findOrFail($request->id);
        if ($destination->image && file_exists(public_path($destination->image))) {
            unlink(public_path($destination->image));
        }
        $destination->delete();
        return response()->json(['success' => 'Deleted successfully']);
    }
}
