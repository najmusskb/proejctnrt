<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::latest()->get();
        return view('admin.blog', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $item = new Blog();
        $item->title = $request->title;
        $item->slug = Str::slug($request->title) . '-' . uniqid();
        $item->author = $request->author;
        $item->short_description = $request->short_description;
        $item->description = $request->description;
        $item->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $item->image = $this->imageUpload($request, 'image', 'uploads/blogs');
        }

        $item->save();

        return redirect()->route('blog.index')->with('message', 'Blog added successfully!')->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $blogData = Blog::findOrFail($id);
        $blog = Blog::latest()->get();
        return view('admin.blog', compact('blogData', 'blog'));
    }

    public function update(Request $request, $id)
    {
        $item = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:blogs,title,'.$id,
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $item->title = $request->title;
        $item->slug = Str::slug($request->title) . '-' . $item->id;
        $item->author = $request->author;
        $item->short_description = $request->short_description;
        $item->description = $request->description;
        $item->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }
            $item->image = $this->imageUpload($request, 'image', 'uploads/blogs');
        }

        $item->save();

        return redirect()->route('blog.index')->with('message', 'Blog updated successfully!')->with('alert-type', 'success');
    }

    public function destroy(Request $request)
    {
        $item = Blog::findOrFail($request->id);
        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }
        $item->delete();
        return response()->json(['success' => true]);
    }
}
