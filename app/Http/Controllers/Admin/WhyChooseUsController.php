<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        $why_choose_us = WhyChooseUs::latest()->get();
        return view('admin.why_choose_us', compact('why_choose_us'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $item = new WhyChooseUs();
        $item->title = $request->title;
        $item->icon = $request->icon;
        $item->description = $request->description;
        $item->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $item->image = $this->imageUpload($request, 'image', 'uploads/why_choose_us');
        }

        $item->save();

        return redirect()->route('why_choose_us.index')->with('message', 'Item added successfully!')->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $whyData = WhyChooseUs::findOrFail($id);
        $why_choose_us = WhyChooseUs::latest()->get();
        return view('admin.why_choose_us', compact('whyData', 'why_choose_us'));
    }

    public function update(Request $request, $id)
    {
        $item = WhyChooseUs::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $item->title = $request->title;
        $item->icon = $request->icon;
        $item->description = $request->description;
        $item->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }
            $item->image = $this->imageUpload($request, 'image', 'uploads/why_choose_us');
        }

        $item->save();

        return redirect()->route('why_choose_us.index')->with('message', 'Item updated successfully!')->with('alert-type', 'success');
    }

    public function destroy(Request $request)
    {
        $item = WhyChooseUs::findOrFail($request->id);
        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }
        $item->delete();
        return response()->json(['success' => true]);
    }
}
