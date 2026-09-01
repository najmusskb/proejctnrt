<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {
        $setting = \App\Models\HomePageSetting::first();
        if (!$setting) {
            $setting = new \App\Models\HomePageSetting();
        }
        return view('admin.home_page_settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = \App\Models\HomePageSetting::first();
        if (!$setting) {
            $setting = new \App\Models\HomePageSetting();
        }

        $setting->fill($request->except(['_token', '_method']));
        $setting->save();

        return redirect()->back()->with('success', 'Home Page Settings updated successfully!');
    }
}
