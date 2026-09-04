<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Companyprofile;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Stat;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class FrontendApiController extends Controller
{
    public function home()
    {
        $sliders         = Slider::latest()->get();
        $destinations    = Destination::where('status', 1)->get();
        $tours           = Product::with(['category', 'destination', 'images'])->where('status', 1)->latest()->take(8)->get();
        $allTours        = Product::with(['category', 'destination', 'images'])->where('status', 1)->latest()->get();
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
        $homeSetting     = HomePageSetting::first();

        return response()->json([
            'sliders'        => $sliders,
            'destinations'   => $destinations,
            'tours'          => $tours,
            'allTours'       => $allTours,
            'whyChooseUs'    => $whyChooseUs,
            'faqs'           => $faqs,
            'blogs'          => $blogs,
            'services'       => $services,
            'testimonials'   => $testimonials,
            'stats'          => $stats,
            'homeCategories' => $homeCategories,
            'partners'       => $partners,
            'deals'          => $deals,
            'gallery'        => $gallery,
            'about'          => $about,
            'company'        => $company,
            'homeSetting'    => $homeSetting,
        ]);
    }

    public function company()
    {
        $company = Companyprofile::first();
        $about   = About::first();
        return response()->json([
            'company' => $company,
            'about'   => $about,
        ]);
    }

    public function tours(Request $request)
    {
        $query = Product::with(['category', 'destination', 'images'])->where('status', 1);

        if ($request->filled('attraction')) {
            $query->whereHas('destination', function ($q) use ($request) {
                $q->where('slug', $request->attraction);
            });
        }

        if ($request->filled('type')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->type);
            });
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('description', 'like', "%{$s}%")
                  ->orWhere('title', 'like', "%{$s}%");
            });
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_high') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'oldest') {
                $query->orderBy('id', 'asc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $tours = $query->get();
        $destinations = Destination::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $company = Companyprofile::first();

        return response()->json([
            'tours'        => $tours,
            'destinations' => $destinations,
            'categories'   => $categories,
            'company'      => $company,
        ]);
    }

    public function tickets()
    {
        $tours = Product::with(['category', 'destination', 'images'])->where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->get();
        $company = Companyprofile::first();

        return response()->json([
            'tours'      => $tours,
            'categories' => $categories,
            'company'    => $company,
        ]);
    }

    public function destinations()
    {
        $destinations = Destination::where('status', 1)->get();
        $company = Companyprofile::first();

        return response()->json([
            'destinations' => $destinations,
            'company'      => $company,
        ]);
    }

    public function destination($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $tours = Product::with(['category', 'destination', 'images'])->where('destination_id', $destination->id)->where('status', 1)->latest()->get();
        $company = Companyprofile::first();

        return response()->json([
            'destination' => $destination,
            'tours'       => $tours,
            'company'     => $company,
        ]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $tours = Product::with(['category', 'destination', 'images'])->where('category_id', $category->id)->where('status', 1)->latest()->get();
        $company = Companyprofile::first();

        return response()->json([
            'category' => $category,
            'tours'    => $tours,
            'company'  => $company,
        ]);
    }

    public function tour($slug)
    {
        $tour = Product::with(['category', 'destination', 'reviews', 'images'])->where('slug', $slug)->firstOrFail();
        $company = Companyprofile::first();
        
        $related = Product::with(['category', 'destination', 'images'])
            ->where('id', '!=', $tour->id)
            ->where('status', 1)
            ->where(function ($q) use ($tour) {
                if ($tour->category_id) {
                    $q->where('category_id', $tour->category_id);
                }
            })
            ->latest()
            ->take(4)
            ->get();

        if ($related->count() < 4) {
            $ids = $related->pluck('id')->push($tour->id);
            $extra = Product::with(['category', 'destination', 'images'])
                ->where('status', 1)
                ->whereNotIn('id', $ids)
                ->latest()
                ->take(4 - $related->count())
                ->get();
            $related = $related->merge($extra);
        }

        $faqs = Faq::where('status', 1)->orderBy('order')->take(6)->get();

        return response()->json([
            'tour'    => $tour,
            'related' => $related,
            'faqs'    => $faqs,
            'company' => $company,
        ]);
    }

    public function services()
    {
        $services = Service::where('status', 1)->orderBy('order')->get();
        $company = Companyprofile::first();

        return response()->json([
            'services' => $services,
            'company'  => $company,
        ]);
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->where('status', 1)->firstOrFail();
        $services = Service::where('status', 1)->where('id', '!=', $service->id)->orderBy('order')->get();
        $whyChooseUs = WhyChooseUs::where('status', 1)->orderBy('id')->get();
        $company = Companyprofile::first();

        return response()->json([
            'service'     => $service,
            'services'    => $services,
            'whyChooseUs' => $whyChooseUs,
            'company'     => $company,
        ]);
    }

    public function blogs(Request $request)
    {
        $query = Blog::where('status', 1);
        
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('description', 'like', "%{$s}%");
            });
        }

        $blogs = $query->latest()->paginate(9);
        $recent = Blog::where('status', 1)->latest()->take(5)->get();
        $company = Companyprofile::first();

        return response()->json([
            'blogs'   => $blogs,
            'recent'  => $recent,
            'company' => $company,
        ]);
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', 1)->firstOrFail();
        $recent = Blog::where('status', 1)->where('id', '!=', $blog->id)->latest()->take(3)->get();
        $company = Companyprofile::first();

        return response()->json([
            'blog'    => $blog,
            'recent'  => $recent,
            'company' => $company,
        ]);
    }

    public function gallery()
    {
        $gallery = Gallery::orderBy('id')->get();
        $company = Companyprofile::first();

        return response()->json([
            'gallery' => $gallery,
            'company' => $company,
        ]);
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:60',
            'email'   => 'required|email|max:100',
            'phone'   => 'required|string|max:20',
            'subject' => 'nullable|string|max:100',
            'message' => 'required|string',
        ]);

        $contact = new Contact();
        $contact->name    = $request->name;
        $contact->email   = $request->email;
        $contact->phone   = $request->phone;
        $contact->subject = $request->subject ?? 'Website Inquiry';
        $contact->message = $request->message;
        $contact->save();

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully! Our team will contact you soon.',
        ]);
    }

    public function tourReviews($slug)
    {
        $tour = Product::where('slug', $slug)->firstOrFail();
        $reviews = Review::where('product_id', $tour->id)->latest()->get();

        $avg = $reviews->avg('rating');

        return response()->json([
            'reviews' => $reviews,
            'average_rating' => $avg ? round($avg, 1) : 0,
            'total_reviews' => $reviews->count(),
        ]);
    }

    public function submitReview(Request $request, $slug)
    {
        $tour = Product::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'nullable|email|max:190',
            'rating'  => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:2000',
        ]);

        $review = Review::create([
            'product_id' => $tour->id,
            'name'       => $request->name,
            'email'      => $request->email,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        $all = Review::where('product_id', $tour->id);
        $tour->rating = round($all->avg('rating'), 1);
        $tour->reviews_count = $all->count();
        $tour->save();

        return response()->json([
            'success'         => true,
            'message'         => 'Thank you! Your review has been submitted.',
            'review'          => $review,
            'average_rating'  => $tour->rating,
            'total_reviews'   => $tour->reviews_count,
        ]);
    }
}
