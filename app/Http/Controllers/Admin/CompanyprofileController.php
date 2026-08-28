<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Companyprofile;
use Illuminate\Http\Request;

class CompanyprofileController extends Controller
{
    public function index()
    {
        $com_profile = Companyprofile::first();
        return view('admin.company_profile', compact('com_profile'));
    }

    public function update(Request $request, $id)
    {
        try {
            $com_profile = CompanyProfile::find($id);

            //logo image 
            $logoImg = $com_profile->logo;
            if ($request->hasFile('logo')) {
                if (!empty($com_profile->logo) && file_exists($com_profile->logo)) 
                    unlink($com_profile->logo);
                $logoImg = $this->imageUpload($request, 'logo', 'uploads/company');
            }

            // favicon image 
            $faviconImg = $com_profile->favicon;
            if ($request->hasFile('favicon')) {
                if (!empty($com_profile->favicon) && file_exists($com_profile->favicon)) 
                    unlink($com_profile->favicon);
                $faviconImg = $this->imageUpload($request, 'favicon', 'uploads/company');
            }

            // CTA background image 
            $ctaBg = $com_profile->cta_bg;
            if ($request->hasFile('cta_bg')) {
                if (!empty($com_profile->cta_bg) && file_exists($com_profile->cta_bg)) 
                    unlink($com_profile->cta_bg);
                $ctaBg = $this->imageUpload($request, 'cta_bg', 'uploads/company');
            }

            $com_profile->com_name = $request->com_name;
            $com_profile->phone = $request->phone;
            $com_profile->whatsapp = $request->whatsapp;
            $com_profile->phone_two = $request->phone_two;
            $com_profile->phone_three = $request->phone_three;
            $com_profile->email = $request->email;
            $com_profile->email1 = $request->email1;
            $com_profile->address = $request->address;
            $com_profile->facebook = $request->facebook;
            $com_profile->twitter = $request->twitter;
            $com_profile->youtube = $request->youtube;
            $com_profile->instagram = $request->instagram;
            $com_profile->counter1_icon = $request->counter1_icon;
            $com_profile->counter1_number = $request->counter1_number;
            $com_profile->counter1_label = $request->counter1_label;
            $com_profile->counter2_icon = $request->counter2_icon;
            $com_profile->counter2_number = $request->counter2_number;
            $com_profile->counter2_label = $request->counter2_label;
            $com_profile->counter3_icon = $request->counter3_icon;
            $com_profile->counter3_number = $request->counter3_number;
            $com_profile->counter3_label = $request->counter3_label;
            $com_profile->counter4_icon = $request->counter4_icon;
            $com_profile->counter4_number = $request->counter4_number;
            $com_profile->counter4_label = $request->counter4_label;
            $com_profile->logo = $logoImg;
            $com_profile->favicon = $faviconImg;
            $com_profile->cta_bg = $ctaBg;
            $com_profile->map = $request->map;
            $com_profile->save();

            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // return $e->getMessage();
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
