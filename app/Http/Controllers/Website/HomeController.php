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
    private function spaView()
    {
        $company = Companyprofile::first();
        $content = $company;
        return view('layouts.spa', compact('company', 'content'));
    }

    public function index()
    {
        return $this->spaView();
    }

    public function tours(Request $request)
    {
        return $this->spaView();
    }

    public function tickets()
    {
        return $this->spaView();
    }

    public function contact()
    {
        return $this->spaView();
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
        return $this->spaView();
    }

    public function destinations()
    {
        return $this->spaView();
    }

    public function destination($slug)
    {
        return $this->spaView();
    }

    public function category($slug)
    {
        return $this->spaView();
    }

    public function serviceDetail($slug)
    {
        return $this->spaView();
    }

    public function blogDetail($slug)
    {
        return $this->spaView();
    }

    public function blogs()
    {
        return $this->spaView();
    }

    public function services()
    {
        return $this->spaView();
    }

    public function gallery()
    {
        return $this->spaView();
    }
}
