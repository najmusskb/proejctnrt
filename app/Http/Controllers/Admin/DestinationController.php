<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::orderBy('sort_order')->get();
        return view('admin.destination', compact('destinations'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:100',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp',
        ]);

        $dest = new Destination();
        $dest->name        = $request->name;
        $dest->description = $request->description;
        $dest->link        = $request->link ?? '#tours';
        $dest->is_active   = $request->is_active ?? 1;
        $dest->sort_order  = $request->sort_order ?? 0;
        $dest->image       = $this->imageUpload($request, 'image', 'uploads/destination');
        $dest->save();

        return redirect()->back()->with(['message' => 'Destination Added!', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $destinations = Destination::orderBy('sort_order')->get();
        $destinationData = Destination::findOrFail($id);
        return view('admin.destination', compact('destinations', 'destinationData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
        ]);

        $dest = Destination::findOrFail($id);
        $dest->name        = $request->name;
        $dest->description = $request->description;
        $dest->link        = $request->link ?? '#tours';
        $dest->is_active   = $request->is_active ?? 1;
        $dest->sort_order  = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            if (!empty($dest->image) && file_exists($dest->image)) unlink($dest->image);
            $dest->image = $this->imageUpload($request, 'image', 'uploads/destination');
        }
        $dest->save();

        return redirect()->route('destination.index')->with(['message' => 'Destination Updated!', 'alert-type' => 'success']);
    }

    public function destroy(Request $request)
    {
        $dest = Destination::find($request->id);
        if ($dest) {
            if (!empty($dest->image) && file_exists($dest->image)) unlink($dest->image);
            $dest->delete();
        }
        return response()->json(['message' => 'Deleted Successfully', 'success' => true]);
    }
}
