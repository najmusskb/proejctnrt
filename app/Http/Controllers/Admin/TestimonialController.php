<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::latest()->get();
        return view('admin.testimonial', compact('testimonial'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'review' => 'required',
            'image' => 'nullable|image',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->review = $request->review;
        $testimonial->rating = $request->rating ?? 5;
        $testimonial->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $testimonial->image = $this->imageUpload($request, 'image', 'uploads/testimonials');
        }

        $testimonial->save();

        return redirect()->route('testimonial.index')->with('message', 'Testimonial added successfully!')->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $testimonialData = Testimonial::findOrFail($id);
        $testimonial = Testimonial::latest()->get();
        return view('admin.testimonial', compact('testimonialData', 'testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'review' => 'required',
            'image' => 'nullable|image',
        ]);

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->review = $request->review;
        $testimonial->rating = $request->rating ?? 5;
        $testimonial->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }
            $testimonial->image = $this->imageUpload($request, 'image', 'uploads/testimonials');
        }

        $testimonial->save();

        return redirect()->route('testimonial.index')->with('message', 'Testimonial updated successfully!')->with('alert-type', 'success');
    }

    public function destroy(Request $request)
    {
        $testimonial = Testimonial::findOrFail($request->id);
        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image));
        }
        $testimonial->delete();
        return response()->json(['success' => true]);
    }
}
