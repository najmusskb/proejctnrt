<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::latest()->get();
        return view('admin.brand', compact('brand'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:brands,name',
            'image' => 'required|Image|mimes:jpg,jpeg,png,gif,webp'
        ]);
        
        try {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->image = $this->imageUpload($request, 'image', 'uploads/brand');
            $brand->created_by = Auth::id();
            $brand->ip_address = $request->ip();
            $brand->save();

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
        $brandData = Brand::find($id);
        $brand = Brand::latest()->get();
        return view('admin.brand', compact('brandData', 'brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:brands,name,'.$id,
            'image' => 'Image|mimes:jpg,jpeg,png,gif,webp'
        ]);
        
        try {
            $brand = Brand::find($id);
            $brandImg = $brand->image;
            if($request->hasFile('image')){
                if (!empty($brand->image) && file_exists($brand->image)) {
                    unlink($brand->image);
                    $brandImg = $this->imageUpload($request, 'image', 'uploads/brand');
                }
            }
            $brand->name = $request->name;
            $brand->image = $brandImg;
            $brand->updated_by = Auth::id();
            $brand->ip_address = $request->ip();
            $brand->save();

            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('brands.index')->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $brand = Brand::find($request->id);
            if($brand){
                if(file_exists($brand->image) AND !empty($brand->image)){
                    unlink($brand->image);
                }
                $brand->delete();
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
