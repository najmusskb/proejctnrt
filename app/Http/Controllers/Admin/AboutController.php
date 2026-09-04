<?php
namespace App\Http\Controllers\Admin;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.about', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'required',
            'image' => 'Image|mimes:jpg,jpeg,png,gif,webp',
        ]);
        try {
            $about = About::find($id);

            //logo image 
            $aboutImg = $about->image;
            if ($request->hasFile('image')) {
                if (!empty($about->image) && file_exists($about->image)) 
                    unlink($about->image);
                $aboutImg = $this->imageUpload($request, 'image', 'uploads/about');
            }

            $about->title = $request->title;
            $about->subtitle = $request->subtitle;
            $about->description = $request->description;
            $about->checkmarks = array_filter($request->checkmarks ?? []);
            $about->button_text = $request->button_text;
            $about->button_link = $request->button_link;
            $about->button2_text = $request->button2_text;
            $about->button2_link = $request->button2_link;
            $about->counter1_number = $request->counter1_number;
            $about->counter1_label = $request->counter1_label;
            $about->counter2_number = $request->counter2_number;
            $about->counter2_label = $request->counter2_label;
            $about->badge_number = $request->badge_number;
            $about->badge_label = $request->badge_label;
            $about->updated_by = Auth::id();
            $about->ip_address = $request->ip();
            $about->image = $aboutImg;
            $about->save();

            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
