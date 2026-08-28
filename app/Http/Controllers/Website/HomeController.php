<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Companyprofile;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Package;
use App\Models\Product;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;

class HomeController extends Controller
{
    public function index()
    {
        $sliders       = Slider::latest()->get();
        $destinations  = Destination::where('is_active', 1)->orderBy('sort_order')->get();
        $tours         = Product::with('category')->where('is_hot', 1)->latest()->take(8)->get();
        $allTours      = Product::with('category')->latest()->get();
        $packages      = Package::where('is_active', 1)->orderBy('sort_order')->get();
        $whyChooseUs   = WhyChooseUs::orderBy('id')->get();
        $faqs          = Faq::orderBy('id')->get();
        $blogs         = Blog::latest()->take(3)->get();
        $services      = Service::where('status', 1)->orderBy('order')->get();
        $testimonials  = Testimonial::latest()->take(6)->get();
        $company       = Companyprofile::first();
        $content       = $company;

        return view('frontend.home', compact(
            'sliders', 'destinations', 'tours', 'allTours', 'services',
            'packages', 'whyChooseUs', 'faqs', 'blogs', 'testimonials', 'company', 'content'
        ));
    }

    public function show($slug)
    {
        $tour    = Product::with(['category'])->where('slug', $slug)->firstOrFail();
        $company = Companyprofile::first();
        $content = $company;
        $related = Product::with('category')
                        ->where('id', '!=', $tour->id)
                        ->where(function ($q) use ($tour) {
                            if ($tour->category_id) {
                                $q->where('category_id', $tour->category_id);
                            }
                        })
                        ->orWhere('is_hot', 1)
                        ->latest()
                        ->take(4)
                        ->get();

        if ($related->count() < 4) {
            $ids    = $related->pluck('id')->push($tour->id);
            $extra  = Product::with('category')->whereNotIn('id', $ids)->latest()->take(4 - $related->count())->get();
            $related = $related->merge($extra);
        }

        $faqs = Faq::orderBy('id')->take(4)->get();

        return view('frontend.tour-detail', compact('tour', 'related', 'faqs', 'company', 'content'));
    }
}
