<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:categories,name',
            'image' => 'required|Image|mimes:jpg,jpeg,png,gif,webp'
        ]);
        
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->section = $request->section ?? 'furniture';
            $category->description = $request->description;
            $category->image = $this->imageUpload($request, 'image', 'uploads/category');
            $category->created_by = Auth::id();
            $category->ip_address = $request->ip();
            $category->save();

            $notification=array(
                'message'=>'Data Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $categoryData = Category::find($id);
        $categories = Category::latest()->get();
        return view('admin.category', compact('categoryData', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:categories,name,'.$id,
            'image' => 'Image|mimes:jpg,jpeg,png,gif,webp'
        ]);
        
        try {
            $category = Category::find($id);
            $catImg = $category->image;
            if ($request->hasFile('image')) {
                if(!empty($category->image) && file_exists($category->image)){
                    unlink($category->image);
                    $catImg = $this->imageUpload($request, 'image', 'uploads/category');
                }
            }
            $category->name = $request->name;
            $category->section = $request->section ?? 'furniture';
            $category->description = $request->description;
            $category->image = $catImg;
            $category->updated_by = Auth::id();
            $category->ip_address = $request->ip();
            $category->save();

            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('category.index')->with($notification);
        } catch (\Exception $e) {
            // $e->getMessage();
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $category = Category::find($request->id);
            if($category){
                if(file_exists($category->image) AND !empty($category->image)){
                    unlink($category->image);
                }
                $category->delete();
            }

            return response()->json([
                'message'=>'Data Deleted Successfully',
                'success'=> true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Something went wrong!',
                'success'=> false
            ]);
        } 
    }
}
