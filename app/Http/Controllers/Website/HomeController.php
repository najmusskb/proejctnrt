<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Companyprofile;
use App\Models\Deal;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Stat;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders         = Slider::latest()->get();
        $destinations    = Destination::where('status', 1)->get();
        $tours           = Product::with('category')->latest()->take(8)->get();
        $allTours        = Product::with('category')->latest()->get();
        $packages        = collect(); // Package is removed
        $whyChooseUs     = WhyChooseUs::where('status', 1)->orderBy('id')->get();
        $faqs            = Faq::where('status', 1)->orderBy('order')->get();
        $blogs           = Blog::where('status', 1)->latest()->take(3)->get();
        $services        = Service::where('status', 1)->orderBy('order')->get();
        $testimonials    = Testimonial::where('status', 1)->latest()->take(6)->get();
        $stats           = Stat::where('status', 1)->orderBy('sort_order')->get();
        $homeCategories  = Category::where('status', 1)->orderBy('id')->get();
        $partners        = Brand::orderBy('id')->get();
        $deals           = Deal::where('status', 1)->orderBy('id')->get();
        $gallery         = Gallery::where('section', 'home')->orWhereNull('section')->orderBy('id')->get();
        $about           = About::first();
        $company         = Companyprofile::first();
        $content         = $company;
        $homeSetting     = \App\Models\HomePageSetting::first();

        return view('frontend.home', compact(
            'sliders', 'destinations', 'tours', 'allTours', 'services',
            'packages', 'whyChooseUs', 'faqs', 'blogs', 'testimonials',
            'stats', 'homeCategories', 'partners', 'deals', 'gallery',
            'about', 'company', 'content', 'homeSetting'
        ));
    }

    public function tickets()
    {
        // For demonstration, we fetch all products or filter by category 'tickets' if it exists.
        // Assuming we just want to list products as tickets for the design
        $tours = Product::with(['category', 'destination'])->where('status', 1)->latest()->get();
        $company = Companyprofile::first();
        $content = $company;

        return view('frontend.tickets', compact('tours', 'company', 'content'));
    }

    public function contact()
    {
        $company = Companyprofile::first();
        $content = $company;
        return view('frontend.contact', compact('company', 'content'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:100',
            'message' => 'required|string',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->back()->with('success', 'Your message has been sent successfully! Our team will contact you soon.');
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

    public function destinations()
    {
        $destinations = Destination::where('status', 1)->get();
        $company = Companyprofile::first();
        $content = $company;

        return view('frontend.destinations', compact('destinations', 'company', 'content'));
    }

    public function destination($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $tours = Product::with('category')->where('destination_id', $destination->id)->latest()->get();
        $company = Companyprofile::first();
        $content = $company;

        return view('frontend.destination-tours', compact('destination', 'tours', 'company', 'content'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $tours = Product::with('category')->where('category_id', $category->id)->latest()->get();
        $company = Companyprofile::first();
        $content = $company;

        return view('frontend.category-tours', compact('category', 'tours', 'company', 'content'));
    }
}
