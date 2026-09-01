<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'destination'])->latest()->get();
        $categories = Category::all();
        $destinations = Destination::all();
        return view('admin.product', compact('products', 'categories', 'destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = new Product();
        $this->saveProduct($product, $request);

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $productData = Product::findOrFail($id);
        $products = Product::with(['category', 'destination'])->latest()->get();
        $categories = Category::all();
        $destinations = Destination::all();
        return view('admin.product', compact('productData', 'products', 'categories', 'destinations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $this->saveProduct($product, $request);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    private function saveProduct($product, $request)
    {
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->destination_id = $request->destination_id;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->badge_type = $request->badge_type;
        $product->rating = $request->rating;
        $product->reviews_count = $request->reviews_count ?? 0;
        $product->duration = $request->duration;
        $product->group_size = $request->group_size;
        $product->free_cancellation = $request->has('free_cancellation') ? 1 : 0;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        
        // Handle JSON fields (if they send array from form, or if just text, encode it)
        $product->included = $request->included ? json_encode(explode("\n", str_replace("\r", "", $request->included))) : null;
        $product->excluded = $request->excluded ? json_encode(explode("\n", str_replace("\r", "", $request->excluded))) : null;
        $product->itinerary = $request->itinerary ? json_encode(explode("\n", str_replace("\r", "", $request->itinerary))) : null;
        
        $product->status = $request->status ?? 1;
        $product->sort_order = $request->sort_order ?? 0;

        $product->map_iframe = $request->map_iframe;
        $product->meeting_point = $request->meeting_point;
        
        if ($request->cancellation_policy) {
            $product->cancellation_policy = json_encode(explode("\n", str_replace("\r", "", $request->cancellation_policy)));
        } else {
            $product->cancellation_policy = null;
        }

        if ($request->faqs_q && $request->faqs_a) {
            $faqs = [];
            foreach ($request->faqs_q as $i => $q) {
                if (!empty($q) && !empty($request->faqs_a[$i])) {
                    $faqs[] = ['q' => $q, 'a' => $request->faqs_a[$i]];
                }
            }
            $product->faqs = json_encode($faqs);
        } else {
            $product->faqs = null;
        }

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = 'uploads/products/' . $imageName;
        }

        $product->save();

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $key => $gImage) {
                $gImageName = time() . $key . '.' . $gImage->extension();
                $gImage->move(public_path('uploads/products/gallery'), $gImageName);
                
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = 'uploads/products/gallery/' . $gImageName;
                $productImage->save();
            }
        }
    }

    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        foreach ($product->images as $img) {
            if ($img->image && file_exists(public_path($img->image))) {
                unlink(public_path($img->image));
            }
            $img->delete();
        }

        $product->delete();
        return response()->json(['success' => 'Deleted successfully']);
    }

    public function deleteImage(Request $request)
    {
        $productImage = ProductImage::findOrFail($request->id);
        if ($productImage->image && file_exists(public_path($productImage->image))) {
            unlink(public_path($productImage->image));
        }
        $productImage->delete();
        return response()->json(['success' => 'Deleted successfully']);
    }
}
