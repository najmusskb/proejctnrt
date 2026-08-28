<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $client = Client::latest()->get();
        return view('admin.client', compact('client'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:100',
            'image' => 'required|Image|mimes:jpg,png,gif,webp'
        ]);

        try {
            $client = new Client();
            $client->name = $request->name;
            $client->image = $this->imageUpload($request, 'image', 'uploads/client');
            $client->created_by = Auth::id();
            $client->ip_address = $request->ip();
            $client->save();

            $notification=array(
                'message'=>'Data Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // $e->getMessage();
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function edit($id)
    {
        $client = Client::latest()->get();
        $clientData = Client::find($id);
        return view('admin.client', compact('client', 'clientData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:100',
            'image' => 'Image|mimes:jpg,png,gif,webp'
        ]);

        try {
            $client = Client::find($id);

            $clirntImg = $client->image;
            if ($request->hasFile('image')) {
                if (!empty($client->image) && file_exists($client->image))
                    unlink($client->image);
                    $clirntImg = $this->imageUpload($request, 'image', 'uploads/client');
            }
            $client->name = $request->name;
            $client->image = $clirntImg;
            $client->updated_by = Auth::id();
            $client->ip_address = $request->ip();
            $client->save();

            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('client.index')->with($notification);

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
            $client = Client::find($request->id);
            if($client){
                if(file_exists($client->image) AND !empty($client->image)){
                    unlink($client->image);
                }
                $client->delete();
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
