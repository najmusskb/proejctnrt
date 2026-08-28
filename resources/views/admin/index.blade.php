@extends('layouts.master')
@section('title', 'Dashboard')
@push('admin-css')
<style>
.dash-head{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
.dash-head .dash-title{font-size:20px;font-weight:700;color:#1e2a3a;margin:0}
.dash-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:18px}
.dash-card{border:none;border-radius:14px;overflow:hidden;box-shadow:0 4px 14px rgba(0,0,0,.08);transition:all .3s;height:100%}
.dash-card:hover{transform:translateY(-5px);box-shadow:0 14px 32px rgba(0,0,0,.18)}
.dash-card a{text-decoration:none;color:#fff;display:block;padding:24px 18px;text-align:center;height:100%}
.dash-card .dash-ico{width:56px;height:56px;margin:0 auto 14px;border-radius:50%;background:rgba(255,255,255,.22);display:flex;align-items:center;justify-content:center;font-size:22px;transition:transform .3s}
.dash-card:hover .dash-ico{transform:scale(1.1)}
.dash-card .dash-card-text{font-size:15px;font-weight:600;margin:0;letter-spacing:.3px}
.g-blue{background:linear-gradient(135deg,#6E0F2B,#8A1538)}
.g-teal{background:linear-gradient(135deg,#8A1538,#A41E45)}
.g-purple{background:linear-gradient(135deg,#A41E45,#C22652)}
.g-pink{background:linear-gradient(135deg,#B4697E,#D98A9C)}
.g-orange{background:linear-gradient(135deg,#8A5A1E,#C7831E)}
.g-red{background:linear-gradient(135deg,#C7831E,#E8B54A)}
.g-green{background:linear-gradient(135deg,#A0522D,#C26A3A)}
.g-indigo{background:linear-gradient(135deg,#B2551F,#D0702F)}
.g-brown{background:linear-gradient(135deg,#6E0F2B,#9E1B40)}
.g-navy{background:linear-gradient(135deg,#C22652,#D23A66)}
.g-cyan{background:linear-gradient(135deg,#B87333,#D28A52)}
.g-slider{background:linear-gradient(135deg,#1e6e8a,#1f7a9c)}
.g-dark{background:linear-gradient(135deg,#B4697E,#E0A7B5)}
@media(max-width:576px){.dash-grid{grid-template-columns:1fr;gap:12px}.dash-card a{padding:18px 14px}.dash-card .dash-ico{width:46px;height:46px;font-size:18px}}
</style>
@endpush
@section('main-content')
<main>
    <div class="container-fluid">
        <div class="dash-head p-2 my-2">
            <span class="my-3 heading"><i class="fas fa-home"></i> <a href="">Home</a> > Dashboard</span>
        </div>

        <div class="dashboard-logo text-center pt-3 pb-4">
            <img class="border p-2" style="height:100px;border-radius:10px" src="{{ asset($content->logo) }}" alt="">
        </div>

        <div class="dash-grid">
            <div class="card mb-3 dash-card g-blue">
                <a href="{{ route('product.index') }}">
                    <div class="dash-ico"><i class="fas fa-couch"></i></div>
                    <p class="dash-card-text">Products ({{ \App\Models\Product::count() }})</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-purple">
                <a href="{{ route('category.index') }}">
                    <div class="dash-ico"><i class="fas fa-layer-group"></i></div>
                    <p class="dash-card-text">Categories ({{ \App\Models\Category::count() }})</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-teal">
                <a href="{{ route('brands.index') }}">
                    <div class="dash-ico"><i class="fas fa-tag"></i></div>
                    <p class="dash-card-text">Brands ({{ \App\Models\Brand::count() }})</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-slider">
                <a href="{{ route('slider.index') }}">
                    <div class="dash-ico"><i class="fas fa-sliders-h"></i></div>
                    <p class="dash-card-text">Add Slider</p>
                </a>
            </div>
            {{-- <div class="card mb-3 dash-card g-purple">
                <a href="{{ route('management.index') }}">
                    <div class="dash-ico"><i class="fas fa-user-cog"></i></div>
                    <p class="dash-card-text">Management</p>
                </a>
            </div> --}}
            <div class="card mb-3 dash-card g-pink">
                <a href="{{ route('gallery.index') }}">
                    <div class="dash-ico"><i class="fas fa-images"></i></div>
                    <p class="dash-card-text">Gallery</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-orange">
                <a href="{{ route('service.index') }}">
                    <div class="dash-ico"><i class="fas fa-concierge-bell"></i></div>
                    <p class="dash-card-text">Services</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-red">
                <a href="{{ route('testimonial.index') }}">
                    <div class="dash-ico"><i class="fas fa-comment-dots"></i></div>
                    <p class="dash-card-text">Testimonials</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-green">
                <a href="{{ route('faq.index') }}">
                    <div class="dash-ico"><i class="fas fa-question-circle"></i></div>
                    <p class="dash-card-text">FAQ</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-indigo">
                <a href="{{ route('why_choose_us.index') }}">
                    <div class="dash-ico"><i class="fas fa-thumbs-up"></i></div>
                    <p class="dash-card-text">Why Choose Us</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-brown">
                <a href="{{ route('blog.index') }}">
                    <div class="dash-ico"><i class="fas fa-blog"></i></div>
                    <p class="dash-card-text">Blog</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-navy">
                <a href="{{ route('company.profile') }}">
                    <div class="dash-ico"><i class="fas fa-address-card"></i></div>
                    <p class="dash-card-text">Company Profile</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-cyan">
                <a href="{{ route('messages.index') }}">
                    <div class="dash-ico"><i class="fas fa-envelope"></i></div>
                    <p class="dash-card-text">Public Message</p>
                </a>
            </div>
            <div class="card mb-3 dash-card g-dark">
                <a href="{{ route('admin.logout') }}">
                    <div class="dash-ico"><i class="fas fa-sign-out-alt"></i></div>
                    <p class="dash-card-text">Sign Out</p>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
