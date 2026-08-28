<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::orderBy('order', 'ASC')->get();
        return view('admin.service', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:services,name',
            'image' => 'nullable|image',
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->slug = Str::slug($request->name);
        $service->icon = $request->icon;
        $service->short_description = $request->short_description;
        $service->description = $request->description;
        $service->type = $request->type ?? 'furniture';
        $service->order = $request->order ?? 0;
        $service->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $service->image = $this->imageUpload($request, 'image', 'uploads/services');
        }

        $service->save();

        return redirect()->route('service.index')->with('message', 'Service added successfully!')->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $serviceData = Service::findOrFail($id);
        $service = Service::orderBy('order', 'ASC')->get();
        return view('admin.service', compact('serviceData', 'service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:services,name,'.$id,
            'image' => 'nullable|image',
        ]);

        $service->name = $request->name;
        $service->slug = Str::slug($request->name);
        $service->icon = $request->icon;
        $service->short_description = $request->short_description;
        $service->description = $request->description;
        $service->type = $request->type ?? 'furniture';
        $service->order = $request->order ?? 0;
        $service->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }
            $service->image = $this->imageUpload($request, 'image', 'uploads/services');
        }

        $service->save();

        return redirect()->route('service.index')->with('message', 'Service updated successfully!')->with('alert-type', 'success');
    }

    public function destroy(Request $request)
    {
        $service = Service::findOrFail($request->id);
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }
        $service->delete();
        return response()->json(['success' => true]);
    }
}
